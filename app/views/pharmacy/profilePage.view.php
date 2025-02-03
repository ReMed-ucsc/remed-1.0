<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/profilePage.css">
</head>

<body>
    <div class="box">
        <div class="container">
            <header>
                <div class="logo">Kodecolor</div>
                <nav>
                    <input type="text" placeholder="Search">
                    <a href="#">Find people</a>
                    <a href="#">Messages</a>
                    <a href="#">My Contacts</a>
                </nav>
            </header>
            <main>
                <section class="profile-header">
                    <div class="profile-pic">
                        <img src="https://via.placeholder.com/100" alt="Profile Picture">
                    </div>
                    <div class="profile-info">
                        <h1>Jeremy Rose</h1>
                        <p class="title">Product Designer</p>
                        <p>New York, NY</p>
                        <div class="rating">
                            <span>8.6</span>
                            <span>★★★★☆</span>
                        </div>
                        <div class="actions">
                            <button>Send Message</button>
                            <button>Contacts</button>
                            <a href="#">Report User</a>
                        </div>
                    </div>
                </section>
                <section class="tabs">
                    <button class="active">Timeline</button>
                    <button>About</button>
                </section>
                <section class="details">
                    <div class="work">
                        <h3>Work</h3>
                        <p><strong>Spotify New York</strong> <span class="tag">Primary</span></p>
                        <p>170 William Street, NY</p>
                        <p><strong>Metropolitan Museum</strong></p>
                        <p>525 E 68th Street, NY</p>
                    </div>
                    <div class="contact-info">
                        <h3>Contact Information</h3>
                        <p><strong>Phone:</strong> +1 123 456 7890</p>
                        <p><strong>Address:</strong> 525 E 68th Street, NY</p>
                        <p><strong>Email:</strong> hello@jeremyrose.com</p>
                        <p><strong>Site:</strong> www.jeremyrose.com</p>
                    </div>
                    <div class="basic-info">
                        <h3>Basic Information</h3>
                        <p><strong>Birthday:</strong> June 5, 1992</p>
                        <p><strong>Gender:</strong> Male</p>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>

</html>