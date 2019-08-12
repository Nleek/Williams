<!DOCTYPE html>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="js/jquery-ui.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Muli|Raleway|Actor|Roboto:500|Open+Sans:300,400,600" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/jquery-ui.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="images/w.png"/>
    <title>Home :: PurpleHelp</title>
    <style>
        main{
            font-family: "SanFranciscoThin", arial;
        }
        #landingSection .parallax_down{
            background: #333 url("images/background3.png") center;
        }
        /*---------------*/
        #button{
            width: 200px;
            height: 60px;
            background-color: #6228a9;
            margin: 0 auto;
            color: #fff;
            text-align: center;
            line-height: 60px;
            font-size: 20px;
        }
        #questionSection{
            width: 100%;
            background-color: #ddd;
        }
        #landingTitle{
            width: 100%;
            padding-top: 30vh;
        }
        #landingTitle img{
            width: 90%;
            max-width: 875px;
            margin: 0 auto;
            height: auto;
            display: block;
            max-height: 200px;
        }
        #questions{
            overflow: hidden;
            margin-top: 1.5em;
        }
        .question, .endpoint{
            width: 80%;
            color: #2d2d2d;
            text-align: center;
            font-size: 30px;
            overflow: hidden;
            margin: 0 auto;
        }
        .question h3{
            margin-top: 1em;
            margin-bottom: 1.5em;
        }
        .question a{
            color: #512698;
            display: block;
            margin-bottom: 20px;
            margin-top: -10px;
        }
        .endpoint{
            display: none;
        }
        .answers{
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: center;
            overflow: visible;
        }
        .material-box{
            flex: 1;
            min-height: 250px;
            position: relative;
            -webkit-transition: all 320ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
            -moz-transition: all 320ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
            -o-transition: all 320ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
            transition: all 320ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
            overflow: visible;
            padding-bottom: 5px;
            margin-left: 0.5em;
            margin-right: 0.5em;
            font-size: 0.75em;
        }
        .material-box:hover .material-box-content,.material-box:hover .material-box-header,.material-box-button:hover{
            -webkit-box-shadow: 0px 0px 5px 0px #949494;
            -moz-box-shadow:    0px 0px 5px 0px #949494;
            -o-box-shadow:      0px 0px 5px 0px #949494;
            box-shadow:         0px 0px 5px 0px #949494;
            cursor: pointer;
        }
        .material-box-header{
            padding: 40px 0px;
            background-color: #ab90c7;
            color: #fff;
            font-size: 1.1em;
        }
        .material-box-content{
            min-height: 260px;
            margin-bottom: 2.6em;
            background-color: #fff;
            overflow: auto;
            font-size: 0.82em;
        }
        .material-box-content p{
            margin: 0;
            padding: 1em;
        }
        .material-box-button{
            display: block;
            border-radius: 50%;
            margin: 0;
            position: absolute;
            bottom: 0.9em;
            left: calc(50% - 1em);
            text-align: center;
            background-color: #7d378d;
            color: #fff;
            border: none;
            font-family: "SanFranciscoThin", arial;
            font-size: 1.5em;
            line-height: 1em;
            padding: 0.35em 0.7em 0.6em 0.7em;
        }
        .material-box-button:hover{
            transform: translateY(-5px);
        }
        .student-or-employee, .student-or-employee .material-box-content{
            min-height: 110px !important;
        }
        #qr-progress{
            -webkit-appearance: none;
            width: 100%;
            height: 15px;
            position: absolute;
            top: 0;
            z-index:1;
        }
        .attached{
            position: fixed !important;
            top:90px !important;
            left: 0;
        }
        progress[value]::-webkit-progress-bar {
            background-color: #eee;
            border-radius: 2px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25) inset;
        }
        progress[value]::-webkit-progress-value {
            background-color: #9878FF;
            border-radius: 2px; 
            background-size: 35px 20px, 100% 100%, 100% 100%;
        }
        progress[value]::-moz-progress-bar { 
            background-color: #9878FF;
            border-radius: 2px; 
            background-size: 35px 20px, 100% 100%, 100% 100%; 
        }
        progress::-webkit-progress-value{
            -webkit-transition: width 500ms cubic-bezier(0.19, 1, 0.22, 1) 10ms;
        }
        progress::-moz-progress-bar {
            -moz-transition: width 500ms cubic-bezier(0.19, 1, 0.22, 1) 10ms;
        }
        @media screen and (max-width: 480px){
            .subtitleBox{
                margin-top: 0.5em;
            }
            #questions{
                margin-top: 3%;
                padding-bottom: 6em;
            }
        }
        .answers select{
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none; 
            min-width: 50%;
            height: 35px;
            border-radius: 0;
            font-family: inherit;
            font-size: 0.8em;
            border: none;
            text-align: center;
            border-bottom: 1px solid #9878ff;
            margin: 10px;
        }
        .answers label{
            display: block;
            min-width: 50%;
            margin: 10px 0;
        }
        .form-error{
            border-color: red !important;
        }
        .inline-block{
            display: inline-block;
        }
        .margin-center{
            margin: 0 auto;
        }
        .relative{
            position: relative;
        }
        .full-width{
            width: calc(80% - 20px);
        }
        .modern-label {
            position: relative;
            display: block;
            margin: 10px 0;
            min-height: 60px;
        }
        .modern-input {
            font: 18px "SanFranciscoLight", arial, sans-serif;
            box-sizing: border-box;
            display: block;
            border: none;
            padding-top: 20px;
            padding-bottom: 20px;
            width: 100%;
            outline: none;
            transition: all 0.2s ease-in-out;
            border-bottom: 1px solid #9878ff;
        }
        .modern-input::placeholder {
            transition: all 0.2s ease-in-out;
            color: #999;
            font: 18px "SanFranciscoLight", arial, sans-serif;
        }
        .modern-input:focus, .modern-input.populated {
            padding-top: 28px;
            padding-bottom: 12px;
        }
        .modern-input:focus::placeholder, .modern-input.populated::placeholder {
            color: transparent;
        }
        .modern-input:focus + span, .modern-input.populated + span {
            opacity: 1;
            top: 10px;
        }
        .modern-label span {
            color: #9878ff;
            font: 13px Helvetica, Arial, sans-serif;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: all 0.2s ease-in-out;
        }
        #endCard{
            padding-top: 10px;
            max-height: calc(100vh - 115px);
            padding-bottom: 10px;
        }
        #endCard .material-box{
            overflow: hidden;
            float: left;
            width: calc(25% - 1em);
        }
        #endCard .material-box:hover{
            cursor: default;
        }
        #endCard .material-box-header{
            padding: 15px 0;
        }
        #endCard .material-box-content{
            padding: 10px 0;
            min-height: 100px;
        }
        #endCard h3{
            margin-bottom: 0.5em;
            margin-top: 0.6em;
            color: #9878FF;
        }
        #endCard h4{
            margin: 0;
        }
        #endCard div{
        }
        #endCard div div{
            text-align: center;
        }
        #endCard div div p{
            padding: 3px;
        }
        #back-button{
            text-transform: capitalize;
            margin-left: 10%;
            display: none;
            padding-top: 1em;
        }
        .material-button{
            padding: 5px 15px 5px 15px;
            -webkit-border-radius:3px;
            -moz-border-radius:3px;
            border-radius:3px;
            font-family: "SanFranciscoLight", arial, sans-serif;
            font-size: 0.7em;
            background-color: #9878ff;
            color: #f0f0f0;
            border: 1px solid #9878ff;
            margin-right: 5px;
            text-transform: uppercase;
        }
        .material-button:hover{
            transform: scale(1.01);
            cursor: pointer;
            -webkit-box-shadow: 0px 0px 5px 0px #ddd;
            -moz-box-shadow:    0px 0px 5px 0px #ddd;
            -o-box-shadow:      0px 0px 5px 0px #ddd;
            box-shadow:         0px 0px 5px 0px #ddd;
        }
        .padding{
            padding: 10px;
        }
        #recaptcha{
            display: none;
            padding: 10px;
            text-align: center;
            margin: 0 auto;
        }
        #recaptcha p{
            margin-top: 0;
        }
        #recaptcha .g-recaptcha{
            display: inline-block;
        }
        .suggestionIcon{
            color: #512698;
            border-bottom: 4px solid #ab90c7;
        }
        .suggestionIcon i{
            font-size: 2.5em;
        }
        @media screen and (max-width: 1439px){
            #endCard .material-box{
                width: calc(33% - 1em);
            }
        }
        @media screen and (max-width: 1100px){
            #endCard .material-box{
                width: calc(50% - 1em);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="margin-center" id="logo">
            <img src="images/purplehelpwhite.png" alt="logo" height="40px" width="200px" />
        </div>
        <ul>
            <a href="index.php"><li class="up_transition transition line-height-center page_on">Home<span class="transition"></span></li></a>
            <a href="troubleshooting.html"><li class="up_transition transition line-height-center">Troubleshooting<span class="transition"></span></li></a>
            <a id="contact-link" href="#contact"><li class="up_transition transition line-height-center">Contact<span class="transition"></span></li></a>
        </ul>
        <div id="mobile-menu" class="transition" data-state="closed">
            <i class="material-icons">dehaze</i>
        </div>
    </header>
    <div id="modal-template" class="">
        <div class="modal hidden">
            <div class="modal-overlay hidden"></div>
            <div class="modal-container">
                <button class="modal-close-button hidden">&times;</button>
                <div class="modal-header text-center">
                    <span class="material-icon-container padding hidden"><i class="material-icons"></i></span>
                    <div class="modal-header-content overflow-hidden"></div>
                </div>
                <div class="modal-body">
                    <div class="modal-content"></div>
                    <div class="modal-buttons hidden"></div>
                </div>
            </div>
        </div>
    </div>
    <main>
        <section id="landingSection" class="parallax_container">
            <div class="parallax_down">
                <div id="landingTitle"><img src="images/purplehelpwhite.png" alt="purple help logo" style=""/></div>
            </div>
            <span id="down" class="transition"><i class="material-icons">keyboard_arrow_down</i></span>
        </section>
        <section id="questionSection">
            <div id="questions">
                <div id="back-button">
                    <span class="material-icon-container"><i class="material-icons">chevron_left</i> back</spaan>
                </div>
                <!-----QUESTION 0------------------------------------------------------------------------------------>
                <article id="Q0" class="question">
                    <h3>Are you a student or employee at Williams?</h3>
                    <div class="answers">
                        <div class="material-box answer endCardMutate transition student-or-employee" data-qr-next="Q1" data-qr-mutate-data="stchelp@williams.edu">
                            <div class="material-box-header transition">
                                <span>Student</span>
                            </div>
                            <div class="material-box-content transition">
                                <label for="student-email" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="student-email" class="dynamic-value modern-input" type="text" name="student-email" placeholder='Enter your Williams student email' />
                                        <span>Enter your Williams student email</span>
                                    </div>
                                </label>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                        <div class="material-box answer endCardMutate transition student-or-employee" data-qr-next="Q1" data-qr-mutate-data="desktop@williams.edu">
                            <div class="material-box-header transition">
                                <span>Employee</span>
                            </div>
                            <div class="material-box-content transition">
                                <label for="employee-email" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="employee-email" class="dynamic-value modern-input" type="text" name="student-email" placeholder='Enter your Williams employee email' />
                                        <span>Enter your Williams employee email</span>
                                    </div>
                                </label>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                    </div>
                </article>
               <!-----QUESTION 1------------------------------------------------------------------------------------>
                <article id="Q1" class="question">
                    <h3>What seems to be the issue?</h3>
                    <div class="answers">
                        <div class="material-box answer transition" data-qr-next="Q2" data-suggest="The slowness you are experiencing may have many factors; but it is possible the issue is with the site you are trying to reach. Be sure to try other sites before continuing. If the issue is consistent throughout multiple sites, try turning your wifi off, wait a couple seconds, and then turn it back on.">
                            <div class="material-box-header transition">
                                <span>Slow Connection</span>
                            </div>
                            <div class="material-box-content transition">
                                <p>
                                    The device is connected to the internet, however it is being slow.
                                </p>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                        <div class="material-box answer transition" data-qr-next="Q2" data-suggest="A common fix for this issue is to turn your wifi off, wait a couple seconds, and then turn it back on.">
                            <div class="material-box-header transition">
                                <span>Connected But..</span>
                            </div>
                            <div class="material-box-content transition">
                                <p>
                                    The device is displaying a connection, but you can't access websites.
                                </p>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                        <div class="material-box answer transition" data-qr-next="QE1">
                            <div class="material-box-header transition">
                                <span>No Connection</span>
                            </div>
                            <div class="material-box-content transition">
                                <p>
                                    The device is not connecting to the internet in any way.
                                </p>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                    </div>
                </article>
                <!-----ENDPOINT 1------------------------------------------------------------------------------------>
                <article id="QE1" class="endpoint">
                    <h3>No Connection</h3>
                    <p>
                        If the device isn't connecting to wireless at all, you should try restarting it and ensure that the wireless is enabled.
                        Also make sure all wireless drivers are updated! If this doesn't work, we recommend bringing it in to student help or Todd Gould and we'll take a look!
                    </p>
                </article>
                <!-----QUESTION 2------------------------------------------------------------------------------------>
                <article id="Q2" class="question">
                    <h3>Take these speed tests and record the results below.</h3>
                    <a href="http://speedtest.net" target="_blank">Speedtest.net</a><a href="" target="_blank">Williams Speed Test</a><br />
                    <div class="answers">
                        <div class="material-box answer transition" data-qr-next="Q3">
                            <div class="material-box-header transition">
                                <span>Results:</span>
                            </div>
                            <div class="material-box-content transition">
                                 <label for="st-download" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="st-download" class="dynamic-value modern-input" type="number" name="SpeedTest.net download" placeholder='Enter the reported Download Speed from SpeedTest.net:' />
                                        <span>Enter the reported Download Speed from SpeedTest.net:</span>
                                    </div>
                                </label>
                                 <label for="st-upload" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="st-upload" class="dynamic-value modern-input" type="number" name="SpeedTest.net upload" placeholder='Enter the reported Upload Speed from SpeedTest.net:' />
                                        <span>Enter the reported Upload Speed from SpeedTest.net:</span>
                                    </div>
                                </label>
                                <label for="w-download" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="w-download" class="dynamic-value modern-input" type="number" name="Williams download" placeholder='Enter the SpeedTest.net reported Download Speed from Williams:' />
                                        <span>Enter the reported Download Speed from Williams:</span>
                                    </div>
                                </label>
                                <label for="w-upload" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="w-upload" class="dynamic-value modern-input" type="number" name="Williams upload" placeholder='Enter the reported Upload Speed from Williams:' />
                                        <span>Enter the reported Upload Speed from Williams:</span>
                                    </div>
                                </label>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                    </div>
                </article>
                <!-----QUESTION 3------------------------------------------------------------------------------------>
                <article id="Q3" class="question">
                    <h3>What website(s) were you trying to access when the issue occured?</h3>
                    <div class="answers">
                        <div class="material-box answer transition" data-qr-next="Q4">
                            <div class="material-box-header transition">
                                <span>Site Address:</span>
                            </div>
                            <div class="material-box-content transition">
                                 <label for="address" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="address" class="dynamic-value modern-input" type="text" name="address" placeholder='www.netflix.com' />
                                        <span>Website URL:</span>
                                    </div>
                                </label>
                                 <label for="site-notes" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="site-notes" class="dynamic-value modern-input populated" type="text" name="notes" placeholder='Additional Notes' value="None" />
                                        <span>Additional Notes:</span>
                                    </div>
                                </label>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                    </div>
                </article>
                <!-----QUESTION 4------------------------------------------------------------------------------------>
                <article id="Q4" class="question">
                    <h3>Do you mind telling us a little bit about the device?</h3>
                    <div class="answers">
                        <div class="material-box transition answer" data-qr-next="Q5">
                            <div class="material-box-header transition">
                                <span>Mac</span>
                            </div>
                            <div class="material-box-content transition">
                                <select class="dynamic-value full-width" name="mac-os">
                                    <option value="">Choose your current operating system:</option>
                                    <option value="macOS Sierra">macOS Sierra</option>
                                    <option value="OSX El Capitan">OSX El Capitan</option>
                                    <option value="OSX Yosemite">OSX Yosemite</option>
                                    <option value="OSX Mavericks">OSX Mavericks</option>
                                </select>
                                <label for="mac-model" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="mac-model" class="dynamic-value modern-input" type="text" name="mac-model" placeholder='Enter the model of your computer:' />
                                        <span>Enter the model of your computer:</span>
                                    </div>
                                </label>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                        <div class="material-box transition answer" data-qr-next="Q6">
                            <div class="material-box-header transition">
                                <span>PC</span>
                            </div>
                            <div class="material-box-content transition">
                                <select class="dynamic-value full-width" name="pc-os">
                                    <option value="">Choose your current operating system:</option>
                                    <option value="Windows 10">Windows 10</option>
                                    <option value="Windows 8.1">Windows 8.1</option>
                                    <option value="Windows 8">Windows 8</option>
                                    <option value="Windows 7">Windows 7</option>
                                    <option value="Linux">Linux</option>
                                </select>
                                <label for="pc-model" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input id="pc-model" class="dynamic-value modern-input" type="text" name="pc-model" placeholder="Enter the model of your computer:" />
                                        <span>Enter the model of your computer:</span>
                                    </div>
                                </label>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                    </div>
                </article>
                <!-----QUESTION 5------------------------------------------------------------------------------------>
                <article id="Q5" class="question">
                    <h3>Download and run the script below. When it's done there will be a file located on your desktop!</h3>
                    <div class="answers">
                        <div class="material-box answer transition answerOptions" data-qr-next="Q7" data-option-class="file">
                            <div class="material-box-header transition">
                                <span>Information Gathering Script (Mac)</span>
                            </div>
                            <div class="material-box-content transition">
                                <p>
                                    This script helps us get a better insight on what your device is doing. After you run it, a file will be located on your desktop.
                                </p>
                                <a href="assets/mac_script.txt" target="_blank" download>Script Download</a>
                                <form id="mac-script-upload">
                                    <label for="upload-mac-file" class="padding">Upload that file here. <input type="file" name="file" id="upload-mac-file" accept="text/*" /></label>
                                </form>
                                <input type="hidden" id="mac-file" class="file" value="uploads/default.txt">
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#upload-mac-file").change(function(){
                            $("#mac-script-upload").submit();
                        });

                        $("#mac-script-upload").on("submit",function(e) {

                            e.preventDefault();
                            $.ajax({
                                url: "php/upload.php", // Url to which the request is send
                                type: "POST",             // Type of request to be send, called as method
                                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                contentType: false,       // The content type used when sending data to the server.
                                cache: false,             // To unable request pages to be cached
                                processData: false,        // To send DOMDocument or non processed data file it is set to false
                                success: function (data)   // A function to be called if request succeeds
                                {
                                    if(data.indexOf("uploads/") > -1){
                                        $("#mac-file").val(data);
                                    }

                                }

                            });

                        });
                    </script>
                </article>
                <!-----QUESTION 6------------------------------------------------------------------------------------>
                <article id="Q6" class="question">
                    <h3>Download and run the script below. When it's done there will be a file located on your desktop!</h3>
                    <div class="answers">
                        <div class="material-box answer transition answerOptions" data-qr-next="Q7" data-option-class="file">
                            <div class="material-box-header transition">
                                <span>Information Gathering Script (PC)</span>
                            </div>
                            <div class="material-box-content transition">
                                <p>
                                    This script helps us get a better insight on what your device is doing. After you run it, a file will be located on your desktop.
                                </p>
                                <a href="assets/pc_script.txt" target="_blank" download>Script Download</a>
                                <form id="pc-script-upload">
                                    <label for="upload-pc-file" class="padding">Upload that file here. <input type="file" name="file" id="upload-pc-file" accept="text/*" /></label>
                                </form>
                                <input type="hidden" id="pc-file" class="file" value="uploads/default.txt">
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#upload-pc-file").change(function(){
                            $("#pc-script-upload").submit();
                        });

                        $("#pc-script-upload").on("submit",function(e) {

                            e.preventDefault();
                            $.ajax({
                                url: "php/upload.php", // Url to which the request is send
                                type: "POST",             // Type of request to be send, called as method
                                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                contentType: false,       // The content type used when sending data to the server.
                                cache: false,             // To unable request pages to be cached
                                processData: false,        // To send DOMDocument or non processed data file it is set to false
                                success: function (data)   // A function to be called if request succeeds
                                {
                                    if(data.indexOf("uploads/") > -1){
                                        $("#pc-file").val(data);
                                    }

                                }

                            });

                        });
                    </script>
                </article>
                <!-----QUESTION 3------------------------------------------------------------------------------------>

                <article id="Q7" class="question">
                    <h3>Have you changed your software recently?</h3>
                    <div class="answers">
                        <div class="material-box answer transition" data-qr-next="Q8">
                            <div class="material-box-header transition">
                                <span>Yes</span>
                            </div>
                            <div class="material-box-content transition">
                                <p>
                                    A change in software can be anything from installing updates, updating one of your applications (Photoshop, Microsoft Office, video games, etc..), or even installing an entirely new one.
                                </p>
                                <label for = "change" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input type="text" name="change" value="" id="change" class="dynamic-value modern-input" placeholder="Software Update" />
                                        <span>Briefly describe the software change:</span>
                                    </div>
                                </label>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                        <div class="material-box answer transition" data-qr-next="Q8">
                            <div class="material-box-header transition">
                                <span>No</span>
                            </div>
                            <div class="material-box-content transition">
                                <p>
                                    You have not altered any software or applications in anyway since the issue has started.  
                                </p>
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
    
                    </div>
                </article>
                <!-----QUESTION 5------------------------------------------------------------------------------------>
                <article id="Q8" class="question">
                    <h3>When and Where is the Issue Occuring?</h3>
                    <div class="answers">
                        <div class="material-box answer transition" data-qr-next="Q9">
                            <div class="material-box-header transition">
                                <span>Time / Location</span>
                            </div>
                            <div class="material-box-content transition">
                                <p>
                                    To help us get a better insight as to where the problem is occurring, we ask you to fill out this information.
                                </p>
                                <label for="autofill-location" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input type="text" class="dynamic-value modern-input" name="location" id="autofill-location" placeholder="Jesup Hall" />
                                        <span>Building:</span>
                                    </div>
                                </label>
                                <label for="room" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input type="text" class="dynamic-value modern-input" name="room" id="room" placeholder="1150" />
                                        <span>Room Number:</span>
                                    </div>
                                </label>
                                <label for="time" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input type="text" class="dynamic-value modern-input" name="time" id="time" placeholder="1:00 PM" />
                                        <span>Approximate Time of occurrence:</span>
                                    </div>
                                </label>
                                <label for="notes" class="modern-label">
                                    <div class="inline-block full-width relative margin-center">
                                        <input type="text" class="dynamic-value modern-input populated" name="notes" id="notes" placeholder="Add any notes you may have" value="None" />
                                        <span>Additional Notes:</span>
                                    </div>
                                </label>
                                <br />
                                <button class="material-box-button material-shadow transition">></button>
                            </div>
                        </div>
                    </div>
                </article>
                <!-----EndCard------------------------------------------------------------------------------------>
                <article id="Q9" class="question">
                    <h3>Does all of this information look correct?</h3>
                    <h5>If so, click the submit button to send it to ITS! <button id="submit-bttn" class="material-button">submit</button></h5>
                    <div id="recaptcha">
                        <p>Solve the captcha and click go!</p>
                        <form id="content">
                            <div class="g-recaptcha" data-sitekey="6LfwXBcUAAAAAGNHcv2OkAm6HZ5p6ADvgb8_uu5w"></div>
                            <input id="sof" name="sof" type="hidden">
                            <input id="url" name="url" type="hidden">
                            <input id="c" name="c" type="hidden">
                            <br /><button id="go-bttn" class="material-button">go!</button>
                        </form>
                    </div>
                    <div class="material-box">
                        <div class="material-box-header">Information</div>
                        <div id="endCard" class="material-box-content">

                        </div>
                        <br />
                    </div>
                    <script>
                        $("#submit-bttn").click(function(){
                            for(var i = 0; i < rotate.length; i++){
                                var question = rotate[i];
                                switch(question.name){
                                    case "Are you a student or employee at Williams?":
                                        $("#sof").val(question.selected);
                                        break;
                                    case "Download and run the script below. When it's done there will be a file located on your desktop!":
                                        $("#url").val(question.options.file);
                                        break;
                                    default:
                                        var html = "Q: "+question.name + "<br /> A: " + question.selected;
                                        if(question.inputs.length){

                                            html += "<br />Options [ ";
                                            for(var iid in question.inputs){
                                                html += question.inputs[iid][0]+": "+question.inputs[iid][1]+" | ";
                                            }
                                            html += "]";
                                            
                                        }
                                        html += "<br /><br />";
                                        var content = $("#c").val();
                                        $("#c").val(content + html);
                                        break;
                                }
                            }

                            var captcha = new Modal({

                                icon: false,
                                headerClass:"hidden",
                                headerContent: "",
                                bodyClass:"padding",
                                bodyContent: "<div id='modal-content'></div>",
                                bodyButtons:[],
                                exitButton: false,
                                exitOverlayOnClick: false

                            });
                            captcha.open();
                            $("#recaptcha").appendTo("#modal-content").css({"display":"block"});
                            grecaptcha.reset();
                            $("#go-bttn").click(function(e){
                                e.preventDefault();
                                $(this).html("Loading..").attr("disabled","disabled");
                                $("#content").submit();
                            });
                            $("#content").on("submit",function(e){
                                e.preventDefault();
                                $.ajax({
                                    url: "php/send.php", // Url to which the request is send
                                    type: "POST",             // Type of request to be send, called as method
                                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                    contentType: false,       // The content type used when sending data to the server.
                                    cache: false,             // To unable request pages to be cached
                                    processData: false,        // To send DOMDocument or non processed data file it is set to false
                                    success: function (data)   // A function to be called if request succeeds
                                    {
                                        var popup = new Modal({

                                            icon: false,
                                            headerClass:"hidden",
                                            headerContent: "",
                                            bodyClass:"padding",
                                            bodyContent: "<p>"+data+"</p>",
                                            bodyButtons:[]

                                        });

                                        if(data != "Message has been sent"){

                                            $("#go-bttn").html("Try Again?").removeAttr("disabled");
                                            grecaptcha.reset();

                                        }
                                        else{

                                            $("#go-bttn").html("go!").removeAttr("disabled");
                                            $("#recaptcha").fadeOut(400,function(){
                                               $(this).appendTo("#Q9").css({"display":"none"});
                                            });
                                            captcha.close();

                                            popup.settings.bodyContent = "<h3>ITS will contact you soon regarding your issue!</h3><p>Thank you for contacting us.</p>";

                                            setTimeout(function(){
                                                window.location.reload();
                                            },5000);

                                        }

                                        popup.open();

                                    }

                                });
                            });
                        });
                    </script>
                </article>
            </div>
        </section>
    </main>
    <a id="contact"></a>
    <div id="foot" class="parallax_container">
        <footer id="parallax-foot">
            <div class="helpBox">
                <div class="helpHeaders">Student Help</div>
                <div class="helpContent iconBox"><img class="icon" src="images/phoneicon.png" alt="phone">(413) 597-3088</div>
                <div class="helpContent iconBox"><img class="icon" src="images/emailicon.png" alt="email">stchelp@williams.edu</div>
                <div class="helpContent">Jesup Hall, Room 303</div>
            </div>
            <div class="helpBox">
                <div class="helpHeaders">Faculty Help</div>
                <div class="helpContent iconBox"><img class="icon" src="images/phoneicon.png" alt="phone">(413) 597-4090</div>
                <div class="helpContent iconBox"><img class="icon" src="images/emailicon.png" alt="email">desktop@williams.edu</div>
                <div class="helpContent">Sawyer Library, 2nd Floor</div>
            </div>
        </footer>
    </div>
    <script src="js/global.js"></script>

    <script>
        $(document).ready(function(){
            rotate = $("#questionSection").questionrotate({order:"next",nextClass:"answer"});
            $(".parallax_down").parallax({divisor:-3.5});
            $("#landingTitle").parallax({divisor:-9});

//---------------These values are for the autofill input. These can easily be altered.--------------------       
            var availableTags = [
                "ABC House",
                "B&L Building",
                "Bascom House",
                "Bernhard Music Center",
                "Brinsmade House",
                "Center for Development Economics",
                "Clark Hall",
                "1937 House",
                "1966 Center",
                "Dodd Annex",
                "Droppers House",
                "Facilities Service Building",
                "Facilities Service Building North",
                "Griffin Hall",
                "Hollander Hall",
                "Hopkins Hall",
                "Hopkins Observatory",
                "Jesup Hall",
                "Johnson House",
                "Lawrence Hall",
                "Mason House",
                "Mears House",
                "Mears West",
                "Miller House",
                "Morey House",
                "Oakley Center",
                "Schapiro Hall",
                "Science Center",
                "Sears House",
                "Spencer Studio Art Building",
                "Stetson Hall",
                "Stocking House",
                "Vogt House",
                "Weston Hall",
                "62 Center",
                "Chapin Gallery",
                "Chapin Hall",
                "Goodrich Hall",
                "Greylock Hall",
                "Williams College Museum of Art",
                "Chandler Athletic Center",
                "Cole Field",
                "Cole Field House",
                "Coombs Field",
                "Hunt Tennis Center",
                "Lansing Chapman Rink",
                "Lasell Gymnasium",
                "Simon Squash Center",
                "Towne Field House",
                "Weston Athletic Complex",
                "Campus Safety and Security",
                "Davis Center",
                "Driscoll Dining Hall",
                "Faculty House",
                "Jewish Religious Center",
                "The Log",
                "Mission Park Dining Hall",
                "Paresky",
                "Sloan House",
                "Thompson Health Center",
                "Thompson Memorial Chapel",
                "Children's Center",
                "Mission Park",
                "Sage Hall",
                "Williams Hall",
                "Agard House",
                "Brooks House",
                "Bryant House",
                "Carter House",
                "Chadbourne House",
                "Currier Hall",
                "Dodd House",
                "Doughty House",
                "East College",
                "Fayerweather Hall",
                "Fitch House",
                "Garfield House",
                "Gladden House",
                "Goodrich House",
                "Hubbell House",
                "Lambert House",
                "Lehman Hall",
                "Mark Hopkins House",
                "Milham House",
                "Morgan Hall",
                "Parsons House",
                "Perry House",
                "Poker Flats",
                "Prospect House",
                "Horn Hall",
                "Sewall House",
                "Spencer House",
                "Susan B. Hopkins House",
                "Thompson Hall",
                "Tyler Annex",
                "Tyler House",
                "West College",
                "Wood House",
                "Woodbridge House",
                "Sawyer Library",
                "Schow Science Library"
            ];
            $("#autofill-location").autocomplete({
                source: availableTags
            });

        });

        $(window).scroll(function(){
            var scrollPos = window.pageYOffset || document.documentElement.scrollTop;
            if(scrollPos >= height - 90){
                if(!$("#qr-progress").hasClass("attached")){
                    $("#qr-progress").addClass("attached");
                }
            }
            else{
                if($("#qr-progress").hasClass("attached")){
                    $("#qr-progress").removeClass("attached");
                }
            }
        });
    </script>
</body>
</html>
