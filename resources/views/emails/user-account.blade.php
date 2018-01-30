<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

    /* RESET STYLES */
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {

        /* ALLOWS FOR FLUID TABLES */
        .wrapper {
          width: 100% !important;
            max-width: 100% !important;
        }

        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        .logo img {
          margin: 0 auto !important;
        }

        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        .mobile-hide {
          display: none !important;
        }

        .img-max {
          max-width: 100% !important;
          width: 100% !important;
          height: auto !important;
        }

        /* FULL-WIDTH TABLES */
        .responsive-table {
          width: 100% !important;
        }

        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        .padding {
          padding: 10px 5% 15px 5% !important;
        }

        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }

        .no-padding {
          padding: 0 !important;
        }

        .section-padding {
          padding: 50px 15px 50px 15px !important;
        }

        /* ADJUST BUTTONS ON MOBILE */
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }

        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }

    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important;"  bgcolor="#F5F7FA">

<!-- HEADER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#000000" align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
                <tr>
                    <td align="center" valign="top" style="padding: 15px 0;" class="logo">
                        <a>
                            <img alt="Logo" src="{{ url('img/logo-large.png') }}" width="240" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0">
                        </a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td>
                        <!-- HERO IMAGE -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding">Hey {{ $user->name }},</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding">
                                                <p>Well done and congratulations for downloading the I AM ELITE - mens trainer app and I look forward to seeing your incredible transformation over the coming months!</p>

                                                <p>Your account has been created successfully and your login details have been listed below :)</p>

                                                <p><strong>Username/Email:</strong> {{ $user->email }}</p>

                                                <p><strong>Password:</strong> {{ $password }}</p>

                                                <p>I promise you you are going to full love the app man and I mean it, it the best product I have ever created and I’m stoked to be giving you a free trial account to see what you think and I really hope you do decide to stay on after the 7 days because you have no idea how amazing this app is going to make you look if you follow the process correctly. The way that I have created the app is it works like a transformation program so each week you literally follow exactly what I am doing with my own training, building muscle and dropping body fat at the same time and you will literally be doing the exact same thing that I do in terms of working out and also nutrition as well. Its epic bro!! </p>

                                                <p>You will be doing my workouts, following my meal plans, eating the exact same recipes I use, you get access to the I AM ELITE - accountability group so make sure you request access from inside the app, you get full access to the I AM ELITE progress tracking system, access to all of my education videos, over 500 hours of training and nutrition footage, guaranteed results and everything you could possibly ever need on training and nutrition to get in incredible shape has been included in this app, I promise you you are going to love it man!</p>

                                                <p>Now before I give you access via the link below I want you to make a REAL commitment to yourself RIGHT NOW… I am not joking either haha I want you to make the commitment, this is your chance to look full on amazing and really go after and more importantly achieve the physique you have always wanted! I am going to help you get insane results and be able to maintain them long term so please make the commitment that you will ACTUALLY go through my app and do WHATEVER IT TAKES to reach your goals!</p>

                                                <p>Trust me man, it will be worth it I promise!!! I want to help you make it happen man so listen to what I say inside the app and follow what I get you to do because I swear to you mate it will work!!! 100% guaranteed if you do this properly you will get epic results alright bro?</p>

                                                <p>Get the "I Am Elite" app from the app store, enter your account details and you will have instant access to the I AM ELITE - mens trainer app!</p>

                                                <p>My advice man?</p>

                                                <p>Exploit my app to the absolute fullest!</p>

                                                <p>My app is insanely packed with the highest quality, top of the line professional fitness education out there… You will not find a better system anywhere!! It is bullet proof!</p>

                                                <p>Here is what you get:</p>
                                                <ul>
                                                    <li>New and updated meal plans every single week for you to follow </li>
                                                    <li>New and updated training splits every single week for you to follow</li>
                                                    <li>Get my exact workouts every single day</li>
                                                    <li>Full video tutorials for all of my workouts every single day, that is over 365 of my most intense workouts for you to copy</li>
                                                    <li>Follow my proven training and nutrition protocols</li>
                                                    <li>Over 200 delicious recipes for the meals included in your meal plan</li>
                                                    <li>Over 40 plus detailed exercise demonstrations videos</li>
                                                    <li>Full educational workout tutorial videos</li>
                                                    <li>Full educational nutrition tutorial videos</li>
                                                    <li>I am elite mindset tutorial videos</li>
                                                    <li>Over 500 hours of quality training and nutrition footage</li>
                                                    <li>Full access to the I AM ELITE - accountability group</li>
                                                    <li>Access to the I AM ELITE - progress tracking system</li>
                                                    <li>Direct access to me to answer all of your questions</li>
                                                    <li>Supplement discounts</li>
                                                    <li>Vitamin discounts</li>
                                                </ul>

                                                <p>And so much more!!!</p>

                                                <p>From the bottom of my heart man I genuinely want to help you reach your goals, like I really do, I want to help you as much as I can so please take advantage of the app, use it properly, follow the process and you will achieve your goals I promise you. Failure is not an option! You are going to look amazing if you do this properly and give it all you got man so lets kill it alright!!</p>

                                                <p>If you have any questions hit me up in the I AM ELITE - accountability group and we will be able to communicate properly in there!!</p>

                                                <p>Ill chat to you soon brother cheers!!</p>

                                                <p>Download the app here: <a href="https://app.iamelitemenstrainer.com">app.iamelitemenstrainer.com</a></p>

                                                <p><strong>Jay Piggin</strong></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#F5F7FA" align="center" style="padding: 20px 0px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <!-- UNSUBSCRIBE COPY -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
                <tr>
                    <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                        © I Am Elite Mens Trainer
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>
</body>
</html>
