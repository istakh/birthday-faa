<?php
$nav_items = [
    ["name" => "HOME", "url" => "index.php"],
    ["name" => "PORTFOLIO", "url" => "portfolio.php"],
    ["name" => "ABOUT", "url" => "about.php"],
    ["name" => "CONTACT", "url" => "contact.php"]
];

$all_projects = [
    ["title" => "Brand Identity", "category" => "GRAPHIC DESIGN", "image" => "https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=600&q=80"],
    ["title" => "Editorial Series", "category" => "PHOTOGRAPHY", "image" => "https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=600&q=80"],
    ["title" => "Travel Journal", "category" => "PHOTO & WRITING", "image" => "https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=600&q=80"],
    ["title" => "Minimalist Living", "category" => "INTERIOR DESIGN", "image" => "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80"],
    ["title" => "Urban Architecture", "category" => "PHOTOGRAPHY", "image" => "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80"],
    ["title" => "Visual Storytelling", "category" => "CREATIVE DIRECTION", "image" => "https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=600&q=80"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio — Sophia Carter</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="portfolio-container">
        <header class="portfolio-header">
            <div class="brand-title">SOPHIA CARTER</div>
            <nav class="portfolio-nav">
                <?php foreach ($nav_items as $item): ?>
                    <a href="<?php echo $item['url']; ?>" class="<?php echo $item['name'] === 'PORTFOLIO' ? 'active' : ''; ?>">
                        <?php echo $item['name']; ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </header>

        <section class="page-header-content">
            <span class="sub-heading">MY WORKS</span>
            <h1 class="hero-title">Featured <span>Projects</span></h1>
        </section>

        <section class="featured-projects-section">
            <div class="projects-grid">
                <?php foreach ($all_projects as $project): ?>
                    <div class="project-card">
                        <div class="project-thumb">
                            <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>">
                        </div>
                        <div class="project-details">
                            <h4><?php echo $project['title']; ?></h4>
                            <span><?php echo $project['category']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <footer class="portfolio-footer">
            <a href="contact.php" class="footer-cta-text">
                <span>LET'S CREATE SOMETHING BEAUTIFUL</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </footer>
    </div>
</body>
</html>