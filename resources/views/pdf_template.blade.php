<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historys</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #303030 100%);
            color: #ffffff;
            padding: 40px;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Removed problematic SVG background pattern */
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
        
        header {
            background: linear-gradient(90deg, #ff4d4d, #f9cb28);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }
        
        header::after {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, 30%);
        }
        
        h1 {
            font-size: 3.5em;
            font-weight: 800;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            text-transform: uppercase;
            letter-spacing: -1px;
            color: #ffffff;
            text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.2);
        }
        
        .content {
            padding: 40px;
            position: relative;
        }
        
        .content::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
        }
        
        .info-block {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            border-left: 5px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .info-block::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.05);
            transform: rotate(45deg) translate(20%, -80%);
        }
        
        .history-block {
            border-left-color: #ff4d4d;
        }
        
        .histories-block {
            border-left-color: #f9cb28;
        }
        
        .profile-block {
            border-left-color: #0072ff;
        }
        
        .email-block {
            border-left-color: #00c6ff;
        }
        
        .block-title {
            text-transform: uppercase;
            font-size: 0.8em;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .data {
            font-size: 1.1em;
            line-height: 1.6;
            color: #ffffff;
        }
        
        footer {
            padding: 20px 40px;
            background: rgba(0, 0, 0, 0.3);
            text-align: center;
            font-size: 0.8em;
            color: rgba(255, 255, 255, 0.5);
        }
        
        /* Simple dot pattern background instead of SVG */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: -1;
        }
        
        @media print {
            body {
                background: white;
                color: black;
            }
            
            .container {
                box-shadow: none;
                border: 1px solid #ccc;
                background: white;
            }
            
            header {
                background: #f0f0f0;
            }
            
            h1 {
                color: #333;
                text-shadow: none;
            }
            
            .info-block {
                background: #f9f9f9;
                border-left-color: #333;
            }
            
            .history-block {
                border-left-color: #ff4d4d;
            }
            
            .histories-block {
                border-left-color: #f9cb28;
            }
            
            .profile-block {
                border-left-color: #0072ff;
            }
            
            .email-block {
                border-left-color: #00c6ff;
            }
            
            .block-title {
                color: #555;
            }
            
            .data {
                color: #333;
            }
            
            footer {
                background: #f0f0f0;
                color: #555;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>{{ $title }}</h1>
        </header>
        
        <div class="content">
            <div class="info-block history-block">
                <div class="block-title">History</div>
                <div class="data">{{ $history }}</div>
            </div>
            
            <div class="info-block histories-block">
                <div class="block-title">Histories</div>
                <div class="data">{{ $histories }}</div>
            </div>
            
            <div class="info-block profile-block">
                <div class="block-title">Profile ID</div>
                <div class="data">{{ $profile_id }}</div>
            </div>
            
            <div class="info-block email-block">
                <div class="block-title">Profile Email</div>
                <div class="data">{{ $profile_email }}</div>
            </div>
        </div>
        
        <footer>
            Generated on {{ date('F j, Y') }}
        </footer>
    </div>
</body>
</html>