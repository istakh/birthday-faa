<?php
// Sesuaikan butiran di sini
$gf_name = "My Love";
$special_message = "Happy Birthday to the most amazing girl in my life! Thank you for bringing so much joy, love, and sunshine into my world every single day. I love you endlessly! ❤️";

$gallery_photos = [
    ["url" => "IMG_8262.jpeg", "caption" => "Our First Date ✨"],
    ["url" => "IMG_3871.jpg", "caption" => "Gorgeous Smile 💖"],
    ["url" => "IMG_0288.jpeg", "caption" => "Unforgettable Moments 🌹"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Birthday <?php echo $gf_name; ?>! ❤️</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fail CSS yang Diselaraskan -->
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="birthday-container">
        <!-- Floating Hearts Animation -->
        <div class="floating-hearts">
            <i class="fa-solid fa-heart" style="left: 10%; animation-duration: 6s;"></i>
            <i class="fa-solid fa-heart" style="left: 30%; animation-duration: 8s;"></i>
            <i class="fa-solid fa-heart" style="left: 50%; animation-duration: 5s;"></i>
            <i class="fa-solid fa-heart" style="left: 70%; animation-duration: 7s;"></i>
            <i class="fa-solid fa-heart" style="left: 90%; animation-duration: 9s;"></i>
        </div>

        <!-- HERO SECTION -->
        <header class="hero-section">
            <span class="badge-love">HAPPY BIRTHDAY</span>
            <h1 class="main-title">To My Dearest <span><?php echo $gf_name; ?></span></h1>
            <p class="hero-subtitle"><?php echo $special_message; ?></p>
            <button class="surprise-btn" onclick="alert('I love you so much! You are my everything! 💖')">
                <i class="fa-solid fa-gift"></i>  Click For A Surprise
            </button>
			<p class="hero-subtitle"></p>
		  <a href="index.php" class="surprise-btn">
            <i class="fa-solid fa-arrow-right"></i> NEXT
        </a>
			<p class="hero-subtitle"></p>
		  <a href="mini_game.php" class="surprise-btn">
            <i class="fa-solid fa- "></i>  MINI GAME
        </a>
        </header>

        <!-- PHOTO GALLERY SECTION -->
        <section class="gallery-section">
            <h2>Our Favorite Memories 📸</h2>
            <div class="gallery-grid">
                <?php foreach ($gallery_photos as $photo): ?>
                    <div class="polaroid-card">
                        <img src="<?php echo $photo['url']; ?>" alt="Memory">
                        <p><?php echo $photo['caption']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- LOVE NOTE SECTION -->
        <section class="love-note-section">
            <div class="note-card">
                <h3>A Little Note For You 💌</h3>
                <p>
                    Selamat hari lahir! 🎂 Semoga Allah sentiasa merahmati setiap langkahmu, mempermudahkan segala urusan, meluaskan rezeki, mengurniakan kesihatan yang baik. Semoga segala doa yang baik dimakbulkan dan semoga kita sentiasa berada dalam lindungan-Nya. Aamiin ya Rabbal Alamin. 🤍
.
                </p>
                <span class="signature">Forever Yours ✨</span>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="birthday-footer">
            <p>Made with 100% BY MAARRI❤️ specially for AIFA.</p>
        </footer>
    </div>
</body>
</html>