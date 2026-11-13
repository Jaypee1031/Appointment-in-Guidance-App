<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'guidesched');

// Create database connection
function getDBConnection() {
    try {
        mysqli_report(MYSQLI_REPORT_OFF);
        
        // Use @ to suppress raw PHP warning output when MySQL service is stopped
        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_errno) {
            showDatabaseError($conn->connect_error);
        }
        
        $conn->set_charset("utf8mb4");
        return $conn;
    } catch (Throwable $e) {
        showDatabaseError($e->getMessage());
    }
}

function showDatabaseError($msg) {
    die("
    <!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='UTF-8'>
      <title>Database Error — GuideSched</title>
      <link rel='preconnect' href='https://fonts.googleapis.com'>
      <link href='https://fonts.googleapis.com/css2?family=Sora:wght@600;700&family=Inter:wght@400;600;700&display=swap' rel='stylesheet'>
      <style>
        body { font-family: 'Inter', sans-serif; background: #F6F3FD; color: #211B36; margin:0; padding:40px 20px; display:flex; justify-content:center; }
        .card { background: #fff; border-radius: 20px; border: 1px solid #E7E1F5; box-shadow: 0 8px 24px -12px rgba(43,17,83,0.16); padding: 32px; max-width: 500px; width: 100%; }
        .brand { display:flex; align-items:center; gap:10px; margin-bottom: 20px; }
        .mark { width:36px; height:36px; border-radius:10px; background:#6D28D9; color:#fff; display:flex; align-items:center; justify-content:center; font-family:'Sora',sans-serif; font-weight:700; }
        .title { font-family:'Sora',sans-serif; font-weight:700; font-size:18px; color:#2B1153; }
        .alert { background:#FBEAE8; color:#C0392B; padding:14px; border-radius:12px; font-size:13.5px; font-weight:600; margin-bottom:20px; }
        ol { font-size:13.5px; color:#726C87; line-height:1.7; padding-left:20px; margin:0 0 24px; }
        ol b { color: #211B36; }
        .btn { display:inline-block; background:#6D28D9; color:#fff; text-decoration:none; padding:12px 24px; border-radius:10px; font-weight:700; font-size:13.5px; text-align:center; }
        .btn:hover { background:#5B21B6; }
      </style>
    </head>
    <body>
      <div class='card'>
        <div class='brand'>
          <div class='mark'>GS</div>
          <div class='title'>GuideSched Database Alert</div>
        </div>
        <div class='alert'>
          ⚠️ MySQL is not running on your computer.
        </div>
        <p style='font-size:13.5px; margin-bottom:12px; font-weight:700;'>Please start MySQL in XAMPP:</p>
        <ol>
          <li>Open <b>XAMPP Control Panel</b> on your PC.</li>
          <li>Click <b>Start</b> next to <b>MySQL</b>.</li>
          <li>Once MySQL turns <span style='color:#1C9A5B; font-weight:700;'>green</span>, click Retry below.</li>
        </ol>
        <a href='javascript:location.reload()' class='btn'>Retry Connection</a>
      </div>
    </body>
    </html>
    ");
}

// Close database connection
function closeDBConnection($conn) {
    if ($conn) {
        $conn->close();
    }
}
?>
