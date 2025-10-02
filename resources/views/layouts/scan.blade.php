<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dow Product Authentication</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', 'Arial', sans-serif;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: rgba(65, 84, 101, 1);
            padding: 15px 0;
            z-index: 1000;
        }

        .navbar-brand img {
            height: 40px;
            margin-left: 30px;
        }

        #section_banner {
            background-color: rgba(65, 84, 101, 1);
            color: white;
            text-align: center;
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-content {
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .page-header {
            font-size: 30px;
            font-weight: 300;
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease-out;
        }

        .page-subheader {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 50px;
            animation: fadeInDown 0.8s ease-out 0.2s both;
        }

        .btn {
            display: inline-block;
            padding: 20px 30px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            color: #fff;
            background-color: #ed1c2f;
            border: 1px solid #ffffff;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        /* .btn:hover {
            background-color: #c41828;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(237, 28, 47, 0.4);
        } */

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .auth-container {
            text-align: center;
            margin-top: 100px;
            padding: 40px 40px 0px;
            max-width: 1200px;
            width: 100%;
            z-index: 1;
        }

        .auth-form {
            margin-top: 40px;
        }

        #Code {
            width: 100%;
            max-width: 100%;
            padding: 10px 0;
            font-size: 30px;
            text-align: center;
            border: none;
            border-bottom: 2px solid #000000;
            background: transparent;
            outline: none;
            letter-spacing: 1px;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
            color: #ffffff;
        }

        #Code:focus {
            border-bottom-color: #000000;
        }

        #Code::placeholder {
            color: #ddd;
            letter-spacing: 1px;
        }

        .error-message {
            color: #ed1c2f;
            font-size: 14px;
            margin-top: -20px;
            opacity: 0;
            transition: opacity 0.3s ease;
            min-height: 10px;
        }

        .error-message.show {
            opacity: 1;
            margin-top: -15px;
            margin-bottom: 5px;
        }

        /* Result Section Styles */
        #section_result {
            background-color: #ffffff;
            /* min-height: 400px; */
            display: none;
            align-items: center;
            justify-content: center;
            padding: 30px 20px 15px;
            animation: fadeIn 0.5s ease-out;
        }

        #section_result.show {
            display: flex;
        }

        .result-container {
            text-align: center;
            max-width: 1200px;
            width: 100%;
            padding: 40px 40px 0px;
        }

        .result-code {
            font-size: 32px;
            color: #37474f;
            margin-bottom: 30px;
            /* letter-spacing: 1px; */
        }

        /* Icon Centang */
        .checkmark-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
            display: none;
            animation: scaleIn 0.5s ease-out;
        }

        .checkmark-icon.show {
            display: block;
        }

        .checkmark-icon svg {
            width: 100%;
            height: 100%;
        }

        .checkmark-check {
            stroke: #296829;
            stroke-width: 10;
            fill: none;
            stroke-linecap: square;
            stroke-linejoin: square;
            animation: drawCheck 0.4s ease-out 0.3s forwards;
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
        }

        .result-status {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
            animation: fadeInUp 0.6s ease-out;
        }

        .result-status.suspect {
            color: #000000;
        }

        .result-status.valid {
            color: #296829;
        }

        .result-message {
            font-size: 14px;
            font-weight: lighter;
            text-align: left;
            /* margin-left: -28%; */
            color: #666;
            line-height: 1.6;
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        /* Product Info Table Styles */
        .product-info-section {
            display: none;
            margin-top: 25px;
            width: 100%;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .product-info-section .img-drum {
            max-width: 100%;
            height: auto;
            margin-left: -28%;
            margin-bottom: 10px;
        }

        .product-info-section .img-seal {
            max-width: 100%;
            height: auto;
            margin-left: -50%;
            margin-bottom: 10px;
        }

        .product-info-section.show {
            display: block;
        }

        .product-info-title {
            font-size: 32px;
            font-weight: lighter;
            color: #ed1c2f;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
            padding-top: 30px;
            border-top: 1px solid #e2e1e1;
        }

        .product-security-title {
            font-size: 32px;
            font-weight: lighter;
            color: #ed1c2f;
            text-align: center;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
            padding-top: 30px;
            border-top: 1px solid #e2e1e1;
        }

        .product-info-subtitle {
            font-size: 14px;
            color: #666;
            text-align: left;
            margin: 0 10px 15px;
            line-height: 1.6;
        }

        .product-security-subtitle {
            font-size: 15px;
            font-weight: bold;
            color: #666;
            text-align: left;
            margin: 40px 10px 20px;
            line-height: 1.6;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            /* box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); */
            /* border-radius: 8px; */
            overflow: hidden;
            /* margin-left: 10px; */
        }

        .product-table tr {
            border: 1px solid #e0e0e0;
            transition: background-color 0.2s ease;
        }

        .product-table tr:nth-child(odd) {
            background-color: #fafafa;
        }

        .product-table td {
            text-align: left;
            padding: 12px;
            font-size: 15px;
            border-right: 1px solid #e0e0e0;
        }

        .product-table td:first-child {
            font-weight: 600;
            color: #777777;
            width: 45%;
            /* background-color: #fafafa; */
        }

        .product-table td:last-child {
            color: #777777;
            font-weight: 400;
        }

        .loading-screen {
            display: none;
            text-align: center;
            padding: 60px 20px;
            background-color: #252525;
            animation: fadeIn 0.3s ease-out;
            height: 600px;
        }

        .loading-screen.show {
            display: block;
        }

        .loading-title {
            font-size: 32px;
            font-weight: lighter;
            color: #fffefd;
            margin-top: 200px;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        .loading-spinner {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border: 3px solid #595959;
            border-top: 3px solid #d3921e;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Hide result content when loading */
        .result-content {
            display: none;
        }

        .result-content.show {
            display: block;
        }

        .footer {
            position: fixed;
            background-color: rgba(65, 84, 101, 1);
            width: 100%;
            bottom: 0;
            left: 0;
            padding: 20px 10px 35px;
            color: #ed1c2f;
            font-size: 14px;
            z-index: 100;
        }

        .footer a {
            color: #ed1c2f;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes drawCircle {
            from {
                stroke-dasharray: 0, 283;
            }

            to {
                stroke-dasharray: 283, 283;
            }
        }

        @keyframes drawCheck {
            to {
                stroke-dashoffset: 0;
            }
        }

        #section_banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset('img/sampul-dow.jpg') }}');
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 0;
        }

        #section_banner::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(65, 84, 101, 0.75);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 0;
        }

        @media (max-width: 768px) {
            .page-header {
                font-size: 36px;
            }

            #Code {
                font-size: 20px;
                max-width: 300px;
            }

            .footer {
                text-align: center;
            }

            #section_banner::before,
            #section_banner::after {
                opacity: 1;
            }

            .result-container {
                padding: 20px 0px 0px;
            }

            .result-container p {
                text-align: center;
                margin: 0 10px 15px;
            }

            .result-status {
                font-size: 29px;
            }

            .result-code {
                font-size: 29px;
                margin-bottom: 25px;
            }

            .result-message {
                font-size: 14px;
                margin-left: 0px;
                text-align: justify;
            }

            .checkmark-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 20px;
            }

            .product-info-section .img-drum {
                margin-left: 0;
            }

            .product-info-section .img-seal {
                margin-left: 0;
            }

            .product-info-title {
                font-size: 22px;
            }

            .product-security-title {
                font-size: 22px;
            }

            .product-table td {
                padding: 14px 16px;
                font-size: 13px;
            }

            .product-table td:first-child {
                width: 45%;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <br>
            <br>
        </div>
    </nav>

    <section id="section_banner">
        <div class="auth-container">
            <form class="auth-form" id="authform">
                @csrf
                <input type="text" id="Code" name="Code" value="{{ $code }}" readonly />
                <div class="error-message" id="errorMessage"></div>
                <div>
                    <button type="button" class="btn" id="authenticationbutton">
                        AUTHENTICATE
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <h3 class="loading-title">CHECKING YOUR PRODUCT</h3>
        <div class="loading-spinner"></div>
    </div>

    <!-- Result Section -->
    <section id="section_result">
        <div class="result-container">

            <!-- Result Content (wrap existing content) -->
            <div class="result-content" id="resultContent">
                <div class="result-code">RESULT FOR '<span id="resultCode"></span>'</div>

                <!-- Icon Centang dengan Animasi -->
                <div class="checkmark-icon" id="checkmarkIcon">
                    <svg viewBox="0 0 100 100">
                        <path class="checkmark-check" d="M25,50 L40,65 L75,30" />
                    </svg>
                </div>

                <div class="result-status" id="resultStatus"></div>
                <div class="result-message" id="resultMessage"></div>

                <!-- Product Information Table -->
                <div class="product-info-section" id="productInfoSection">
                    <h3 class="product-info-title">YOUR PRODUCT SPECIFIC INFORMATION</h3>
                    <p class="product-info-subtitle">The following information was assigned to your product during the
                        manufacture process.</p>

                    <table class="product-table">
                        <tr>
                            <td>1 - Product Name</td>
                            <td id="productName">-</td>
                        </tr>
                        <tr>
                            <td>2 - Batch Number</td>
                            <td id="batchNumber">-</td>
                        </tr>
                        <tr>
                            <td>3 - Date of Manufacturing</td>
                            <td id="mfgDate">-</td>
                        </tr>
                        <tr>
                            <td>4 - Date of expiration</td>
                            <td id="expDate">-</td>
                        </tr>
                        <tr>
                            <td>5 - Manufacturing site</td>
                            <td id="mfgSite">-</td>
                        </tr>
                        <tr>
                            <td>6 - Repacking site</td>
                            <td id="repackSite">-</td>
                        </tr>
                    </table>
                </div>

                <!-- Security Label Section -->
                <div class="product-info-section" id="securityLabelSection">
                    <h3 class="product-security-title">DOW PRODUCT WITH SECURITY LABEL</h3>
                    <img class="img-drum" src="{{ asset('img/drum-dow.jpg') }}" alt="Dow Product Drum"
                        style="margin-top: 20px;">
                </div>

                <!-- Security Check Section -->
                <div class="product-info-section" id="securityCheckSection">
                    <h3 class="product-security-title">DRUM SECURITY CHECK</h3>
                    <p class="product-security-subtitle">Please inspect the label to make sure it has the
                        correct security features.</p>
                </div>

                <!-- Seal Label Section -->
                <div class="product-info-section" id="sealLabelSection">
                    <h3 class="product-security-title"></h3>
                    <img class="img-seal" src="{{ asset('img/seal-dow.jpg') }}" alt="Dow Seal">
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <span id="footer__year">2025</span> &copy; <a href="#">Dow Product Authentication</a>
    </footer>

    <div style="height: 70px;"></div>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        function showLoading() {
            const resultSection = document.getElementById('section_result');
            const loadingScreen = document.getElementById('loadingScreen');
            const resultContent = document.getElementById('resultContent');

            // Hide result section with loading
            resultSection.classList.remove('show');
            loadingScreen.classList.add('show');
            resultContent.classList.remove('show');

            // Smooth scroll to loading section
            setTimeout(() => {
                loadingScreen.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        }

        function hideLoading() {
            const resultSection = document.getElementById('section_result');
            const loadingScreen = document.getElementById('loadingScreen');
            const resultContent = document.getElementById('resultContent');

            resultSection.classList.add('show');
            loadingScreen.classList.remove('show');
            resultContent.classList.add('show');
        }

        function showResult(code, isValid, message, productData = null) {
            hideLoading(); // Hide loading before showing result

            const resultCode = document.getElementById('resultCode');
            const resultStatus = document.getElementById('resultStatus');
            const resultMessage = document.getElementById('resultMessage');
            const checkmarkIcon = document.getElementById('checkmarkIcon');
            const productInfoSection = document.getElementById('productInfoSection');
            const securityLabelSection = document.getElementById('securityLabelSection');
            const securityCheckSection = document.getElementById('securityCheckSection');
            const sealLabelSection = document.getElementById('sealLabelSection');

            resultCode.textContent = code;

            if (isValid) {
                resultStatus.textContent = 'YOUR PRODUCT IS AUTHENTIC';
                resultStatus.className = 'result-status valid';
                checkmarkIcon.classList.add('show');

                // Show product information table
                if (productData) {
                    document.getElementById('productName').textContent = productData.product_name || '-';
                    document.getElementById('batchNumber').textContent = productData.batch_number || '-';
                    document.getElementById('mfgDate').textContent = formatDate(productData.manufacture_date) || '-';
                    document.getElementById('expDate').textContent = formatDate(productData.expiry_date) || '-';
                    document.getElementById('mfgSite').textContent = productData.manufacturing_site || '-';
                    document.getElementById('repackSite').textContent = productData.repacking_site || '-';

                    productInfoSection.classList.add('show');
                    securityLabelSection.classList.add('show');
                    securityCheckSection.classList.add('show');
                    sealLabelSection.classList.add('show');
                }
            } else {
                resultStatus.textContent = 'SUSPECT VALIDATION';
                resultStatus.className = 'result-status suspect';
                checkmarkIcon.classList.remove('show');
                productInfoSection.classList.remove('show');
                securityLabelSection.classList.remove('show');
                securityCheckSection.classList.remove('show');
                sealLabelSection.classList.remove('show');
            }

            resultMessage.textContent = message;
        }

        function hideResult() {
            const resultSection = document.getElementById('section_result');
            const loadingScreen = document.getElementById('loadingScreen');
            const resultContent = document.getElementById('resultContent');
            const checkmarkIcon = document.getElementById('checkmarkIcon');
            const productInfoSection = document.getElementById('productInfoSection');
            const securityLabelSection = document.getElementById('securityLabelSection');
            const securityCheckSection = document.getElementById('securityCheckSection');
            const sealLabelSection = document.getElementById('sealLabelSection');

            resultSection.classList.remove('show');
            loadingScreen.classList.remove('show');
            resultContent.classList.remove('show');
            checkmarkIcon.classList.remove('show');
            productInfoSection.classList.remove('show');
            securityLabelSection.classList.remove('show');
            securityCheckSection.classList.remove('show');
            sealLabelSection.classList.remove('show');
        }

        document.getElementById('authenticationbutton').addEventListener('click', function() {
            const code = document.getElementById('Code').value;
            const errorMessage = document.getElementById('errorMessage');
            const button = this;

            // Reset messages and hide result section
            errorMessage.classList.remove('show');
            errorMessage.textContent = '';
            //hideResult(); // Reset everything first

            if (code.trim() === '') {
                // if ()
                errorMessage.textContent = 'You must supply an authentication code to continue.';
                errorMessage.classList.add('show');
                return;
            }

            button.disabled = true;
            // button.textContent = 'AUTHENTICATING...';

            // Show loading screen
            showLoading();

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route('authenticate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    button.disabled = false;
                    button.textContent = 'AUTHENTICATE';

                    // Sembunyikan form setelah mendapat response
                    hideAuthForm();

                    if (data.success) {
                        // Show valid result with product data
                        showResult(
                            code,
                            true,
                            data.message || 'Thank you for your purchase of a genuine product.',
                            data.data
                        );
                        console.log('Product data:', data.data);

                        // Clear input after success
                        document.getElementById('Code').value = '';
                    } else {
                        // Show suspect validation result
                        showResult(
                            code,
                            false,
                            data.message ||
                            'We are not certain about your product. Please contact our customer service team.'
                        );

                        // Clear input even for suspect
                        document.getElementById('Code').value = '';
                    }
                })
                .catch(error => {
                    button.disabled = false;
                    button.textContent = 'AUTHENTICATE';
                    hideResult(); // Hide loading on error
                    errorMessage.textContent = 'An error occurred. Please try again.';
                    errorMessage.classList.add('show');
                    console.error('Error:', error);
                });
        });

        function formatDate(dateString) {
            if (!dateString) return '-';
            const parts = dateString.split('-');
            return `${parts[2]}/${parts[1]}/${parts[0]}`;
        }

        function hideAuthForm() {
            const authForm = document.getElementById('authform');
            authForm.style.display = 'none';
        }
    </script>
</body>

</html>
