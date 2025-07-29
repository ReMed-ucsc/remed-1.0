<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pharmacy/navbar.css">
    </link>
    <link rel="stylesheet" href="colours.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    </link>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pharmacy/index.css">
    </link>
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />



</head>

<body>

    <header>
        <?php

            include BASE_PATH . '/app/views/inc/pharmacy/nonRegNavbar.php';
        
    ?>
    </header>

    <main>
        <div class="landing-container">
            <div class="content ">
                <div class="background">
                    <div class="text-section">
                        <p>
                            The Remed Online Pharmacy Locator helps pharmacies connect with customers by displaying
                            real-time inventory for easy medication searches. By joining the Remed network, pharmacies
                            increase visibility, attract more customers, and streamline order management, enhancing
                            overall service efficiency and satisfaction
                        </p>
                        <button id="registrationButton" class="primary-button">Register Now</button><br>
                        <button id="loginButton" class="secondary-button">Log In</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section class="features-section">
            <h2 data-aos="fade-up">Why Choose Remed?</h2>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon">📊</div>
                    <h3>Real-time Inventory</h3>
                    <p>Keep track of your medication stock with our advanced inventory management system.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon">🎯</div>
                    <h3>Enhanced Visibility</h3>
                    <p>Increase your pharmacy's online presence and reach more customers in your area.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon">📱</div>
                    <h3>Easy Management</h3>
                    <p>User-friendly dashboard to manage orders, inventory, and customer interactions.</p>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="stats-section">
            <div class="stats-container">
                <div class="stat-item" data-aos="zoom-in">
                    <h3>500+</h3>
                    <p>Registered Pharmacies</p>
                </div>
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">
                    <h3>50,000+</h3>
                    <p>Monthly Users</p>
                </div>
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">
                    <h3>98%</h3>
                    <p>Customer Satisfaction</p>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <h2 data-aos="fade-up">How It Works</h2>
            <div class="steps-container">
                <div class="step" data-aos="fade-right">
                    <div class="step-number">1</div>
                    <h3>Register Your Pharmacy</h3>
                    <p>Create your account and complete the verification process</p>
                </div>
                <div class="step" data-aos="fade-right" data-aos-delay="100">
                    <div class="step-number">2</div>
                    <h3>Set Up Inventory</h3>
                    <p>Upload your medication inventory and keep it updated</p>
                </div>
                <div class="step" data-aos="fade-right" data-aos-delay="200">
                    <div class="step-number">3</div>
                    <h3>Start Receiving Orders</h3>
                    <p>Connect with customers and manage orders efficiently</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-content" data-aos="fade-up">
                <h2>Ready to Join Remed?</h2>
                <p>Start growing your pharmacy business today</p>
                <button class="primary-button">Get Started</button>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Remed</h3>
                <p>Connecting pharmacies with customers for better healthcare access.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="<?=ROOT?>/assets/js/pharmacy/navbar.js"></script>
    <script src="<?=ROOT?>/assets/js/pharmacy/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
    AOS.init({
        duration: 800,
        once: true
    });
    </script>

</body>

</html>