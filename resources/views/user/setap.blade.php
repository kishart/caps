<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set an Appointment</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
            font-family: "PT Serif", serif;
            font-weight: 700;
            font-style: normal;
        }

        body,
        html {
            height: 100%;
            font-family: "PT Serif", serif;
            font-weight: 700;
            font-style: normal;

            background-color: #ecb176;
        }

        .container {
            display: flex;
            height: 100vh;
            /* Full height of the viewport */

        }

        .column {
            flex: 1;
            /* Each column takes up equal space */
            padding: 20px;

            display: flex;
            justify-content: center;
            /* Aligns items horizontally (center) */
            align-items: center;
            /* Aligns items vertically (center) */
        }

        .left {
            background-color: #ecb176;
            padding: 0;
        }

        .right {
            background-color: #e8e8e8;
            position: relative;
            /* Required for positioning slider controls */
            overflow: hidden;
            /* Hides overflow content */
        }

        .form-container {
            width: 100%;
            height: 100%;

            background: #fdd3a8;
            padding: 25px 50px 10px 50px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container .text {
            text-align: center;
            font-family: "PT Serif", serif;
            font-weight: 700;
            font-size: 2rem;
            font-style: normal;
            background: #ac6f53;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-container form {
            padding: 30px 0 0 0;
        }

        .form-container form .form-row {
            display: block;
            margin: 32px 0;
        }

        form .form-row .input-data {
            width: 100%;
            height: 40px;
            margin: 20px 0;
            position: relative;
        }

        form .form-row .textarea {
            height: 70px;
        }

        .input-data input,
        .textarea textarea {
            display: block;
            width: 100%;
            height: 100%;
            border: none;
            font-size: 17px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.12);
            background: #fdd3a8;
        }

        .input-data input:focus~label,
        .textarea textarea:focus~label,
        .input-data input:valid~label,
        .textarea textarea:valid~label {
            transform: translateY(-20px);
            font-size: 14px;
            color: #ac6f53;
        }

        .textarea textarea {
            resize: none;
            padding-top: 10px;
        }

        .input-data label {
            position: absolute;
            pointer-events: none;
            bottom: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .textarea label {
            width: 100%;
            bottom: 40px;
            background: #fdd3a8;
        }

        .input-data .underline {
            position: absolute;
            bottom: 0;
            height: 2px;
            width: 100%;
        }

        .input-data .underline:before {
            position: absolute;
            content: "";
            height: 2px;
            width: 100%;
            background: #ac6f53;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s ease;
        }

        .input-data input:focus~.underline:before,
        .input-data input:valid~.underline:before,
        .textarea textarea:focus~.underline:before,
        .textarea textarea:valid~.underline:before {
            transform: scale(1);
        }

        .submit-btn .input-data {
            overflow: hidden;
            height: 45px !important;
            width: 25% !important;
        }

        .submit-btn .input-data .inner {
            height: 100%;
            width: 300%;
            position: absolute;
            left: -100%;
            background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
            transition: all 0.4s;
        }

        .submit-btn .input-data:hover .inner {
            left: 0;
        }

        .submit-btn .input-data input {
            background: none;
            border: none;
            color: #fff;
            font-size: 17px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 700px) {
            .form-container .text {
                font-size: 30px;
            }

            .form-container form {
                padding: 10px 0 0 0;
            }

            .form-container form .form-row {
                display: block;
            }

            form .form-row .input-data {
                margin: 35px 0 !important;
            }

            .submit-btn .input-data {
                width: 40% !important;
            }
        }

        /* Slider Styles */
        .slideshow-container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .slides {
            display: flex;
            width: 100%;
            height: 100%;
            position: relative;
        }

        .slide {
            min-width: 100%;
            height: 100%;
            position: absolute;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .active {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="column left">
            <div class="form-container">
                <div class="text">
                    Set Appointment
                </div>
                <form action="#">
                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" required>
                            <div class="underline"></div>
                            <label for="">Name: </label>
                        </div>
                    </div>
                    <div class="form-row" style="display: flex; justify-content: space-between;">
                        <div class="input-data" style="flex: 1; margin-right: 10px;">
                            <input type="text" required>
                            <div class="underline"></div>
                            <label for="">Email: </label>
                        </div>
                        <div class="input-data" style="flex: 1;">
                            <input type="text" required>
                            <div class="underline"></div>
                            <label for="">Phone Number: </label>
                        </div>
                    </div>
                    <div class="form-row" style="display: flex; justify-content: space-between;">
                        <div class="input-data" style="flex: 1; margin-right: 10px;">
                            <input type="text" required>
                            <div class="underline"></div>
                            <label for="">Date: </label>
                        </div>
                        <div class="input-data" style="flex: 1;">
                            <input type="text" required>
                            <div class="underline"></div>
                            <label for="">Time: </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-data textarea">
                            <textarea rows="8" cols="80" required></textarea>
                            <br />
                            <div class="underline"></div>
                            <label for="">Details</label>
                        </div>
                    </div>
                    <div class="form-row submit-btn">
                        <div class="input-data">
                            <div class="inner"></div>
                            <input type="submit" value="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="column right">
            <div class="slideshow-container">
                <div class="slides">
                    <div class="slide active">
                        <img src="https://via.placeholder.com/800x600/ff7f7f/fff?text=Slide+1" alt="Slide 1">
                        <div class="text">Caption Text 1</div>
                    </div>
                    <div class="slide">
                        <img src="https://via.placeholder.com/800x600/7fff7f/fff?text=Slide+2" alt="Slide 2">
                        <div class="text">Caption Text 2</div>
                    </div>
                    <div class="slide">
                        <img src="https://via.placeholder.com/800x600/7f7fff/fff?text=Slide+3" alt="Slide 3">
                        <div class="text">Caption Text 3</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const slides = document.querySelectorAll('.slide');
        let currentIndex = 0;

        function showNextSlide() {
            slides[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % slides.length;
            slides[currentIndex].classList.add('active');
        }

        setInterval(showNextSlide, 3000); // Change slide every 3 seconds
    </script>
</body>

</html>
