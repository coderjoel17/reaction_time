<?php
// Get the student ID from the URL
$student_id = intval($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reaction Time Tests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            /* Added padding for more space */
            margin-top: 20px;
            background: linear-gradient(135deg, #85B2DB, #A99EE5);
            height: 150vh;
            box-sizing: border-box;
        }

        #box {
            width: 700px;
            /* Reduced width slightly for better balance */
            height: 300px;
            /* Reduced height to make more room for other elements */
            background-color: red;
            margin: 20px auto;
            border-radius: 10px;
            /* Optional: Add rounded corners to the box */
        }

        button {
            font-size: 20px;
            /* Reduced button font size */
            padding: 12px 24px;
            /* Reduced padding to make buttons more compact */
            margin: 15px;
            /* Slightly reduced margin for better spacing */
        }

        .reaction-time {
            font-size: 26px;
            /* Slightly smaller text for the reaction time display */
            margin-top: 20px;
            /* Reduced margin for more space */
        }
    </style>

</head>

<body>

    <h1>Visual Reaction Time Test</h1>
    <p>Press SPACE as soon as the box turns GREEN</p>
    <button id="startButton" onclick="startVisualTest()">Start Visual Test</button>
    <div id="box"></div>
    <div class="reaction-time" id="visualReactionTime"></div>

    <h1>Auditory Reaction Time Test</h1>
    <p>Press SPACE as soon as you hear the sound</p>
    <button id="startAuditoryButton" onclick="startAuditoryTest()">Start Auditory Test</button>
    <div class="reaction-time" id="auditoryReactionTime"></div>

    <audio id="audio" src="sound/buzz.wav"></audio>

    <script>
        let visualResults = [];
        let auditoryResults = [];
        let visualAttempts = 0;
        let auditoryAttempts = 0;

        // Visual Reaction Time Test
        let visualStartTime, visualWaitingForReaction = false;
        document.addEventListener('keydown', function(event) {
            if (event.code === 'Space' && visualWaitingForReaction) {
                recordVisualReactionTime();
            }
        });

        function startVisualTest() {
            document.getElementById('startButton').disabled = true;
            document.getElementById('visualReactionTime').textContent = '';
            document.getElementById('box').style.backgroundColor = 'red';
            setTimeout(startVisualCountdown, Math.random() * 2000 + 1000);
        }

        function startVisualCountdown() {
            let countdownValue = 3;
            const countdownInterval = setInterval(() => {
                document.getElementById('visualReactionTime').textContent = countdownValue;
                countdownValue--;
                if (countdownValue < 0) {
                    clearInterval(countdownInterval);
                    triggerVisualSignal();
                }
            }, 1000);
        }

        function triggerVisualSignal() {
            document.getElementById('box').style.backgroundColor = 'green';
            visualStartTime = Date.now();
            visualWaitingForReaction = true;
        }

        function recordVisualReactionTime() {
            const visualReactionTime = (Date.now() - visualStartTime) / 1000;
            visualResults.push(visualReactionTime);
            visualAttempts++;
            console.log(`Visual Reaction Time ${visualAttempts}: ${visualReactionTime}`); // Debugging

            document.getElementById('visualReactionTime').textContent = `Visual Reaction Time: ${visualReactionTime.toFixed(3)} seconds`;
            document.getElementById('box').style.backgroundColor = 'red';
            visualWaitingForReaction = false;

            if (visualAttempts < 3) {
                document.getElementById('startButton').disabled = false;
            } else {
                saveVisualResults();
            }
        }

        // Auditory Reaction Time Test
        let auditoryStartTime, auditoryWaitingForReaction = false;
        document.addEventListener('keydown', function(event) {
            if (event.code === 'Space' && auditoryWaitingForReaction) {
                recordAuditoryReactionTime();
            }
        });

        function startAuditoryTest() {
            document.getElementById('startAuditoryButton').disabled = true;
            document.getElementById('auditoryReactionTime').textContent = '';
            let countdownValue = 3;
            const countdownInterval = setInterval(() => {
                document.getElementById('auditoryReactionTime').textContent = countdownValue;
                countdownValue--;
                if (countdownValue < 0) {
                    clearInterval(countdownInterval);
                    triggerAuditorySignal();
                }
            }, 1000);
        }

        function triggerAuditorySignal() {
            document.getElementById('auditoryReactionTime').textContent = '';
            setTimeout(playAudio, Math.random() * 6000);
        }

        function playAudio() {
            const audio = document.getElementById('audio');
            audio.play();
            auditoryStartTime = Date.now();
            auditoryWaitingForReaction = true;
        }

        function recordAuditoryReactionTime() {
            const auditoryReactionTime = (Date.now() - auditoryStartTime) / 1000;
            auditoryResults.push(auditoryReactionTime);
            auditoryAttempts++;
            console.log(`Auditory Reaction Time ${auditoryAttempts}: ${auditoryReactionTime}`); // Debugging

            document.getElementById('auditoryReactionTime').textContent = `Auditory Reaction Time: ${auditoryReactionTime.toFixed(3)} seconds`;
            auditoryWaitingForReaction = false;

            if (auditoryAttempts < 3) {
                document.getElementById('startAuditoryButton').disabled = false;
            } else {
                saveAuditoryResults();
            }
        }

        // Save Visual Results to Database
        function saveVisualResults() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "save_test_results.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Debugging: Check the values being sent
            console.log(`Saving Visual Results: vr1=${visualResults[0]}, vr2=${visualResults[1]}, vr3=${visualResults[2]}`);

            // Send the data via POST
            xhr.send(`id=<?php echo $student_id; ?>&vr1=${visualResults[0]}&vr2=${visualResults[1]}&vr3=${visualResults[2]}`);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log("Visual test results saved.");
                }
            };
        }


        // Save Auditory Results to Database
        function saveAuditoryResults() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "save_test_results.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Debug the values being sent
            console.log(`Saving Auditory Results: ar1=${auditoryResults[0]}, ar2=${auditoryResults[1]}, ar3=${auditoryResults[2]}`);

            xhr.send(`id=<?php echo $student_id; ?>&ar1=${auditoryResults[0]}&ar2=${auditoryResults[1]}&ar3=${auditoryResults[2]}`);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Tests completed successfully!");
                    window.location.href = 'http://localhost/simple_website/index.html'; // Redirect to the home page
                }
            };
        }
    </script>


</body>

</html>