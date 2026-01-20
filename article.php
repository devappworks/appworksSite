<?php
// Debug mode - set to false in production
$debug = false;

// Get article ID or slug from URL
$articleId = isset($_GET['id']) ? $_GET['id'] : null;
$articleSlug = isset($_GET['slug']) ? $_GET['slug'] : null;

if ($debug) {
    echo "<!-- DEBUG: Article ID: " . ($articleId ?: 'none') . " -->\n";
    echo "<!-- DEBUG: Article Slug: " . ($articleSlug ?: 'none') . " -->\n";
}

// Default meta values
$pageTitle = "Article - Appworks";
$pageDescription = "Appworks article view";
$pageImage = "https://app-works.app/images/appworks.png";
$pageUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$articleData = null;

// Function to create slug from title
function createSlug($title) {
    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    $slug = preg_replace('/\s+/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

// Function to get category name
function getCategoryName($categoryId) {
    $categories = [
        '3' => 'Sports',
        '4' => 'Media',
        '9' => 'AI',
        '10' => 'Grant Projects'
    ];
    return isset($categories[$categoryId]) ? $categories[$categoryId] : 'General';
}

// Fetch article data from API
if ($articleId || $articleSlug) {
    if ($articleId) {
        $apiUrl = 'https://appworks.mpanel.app/api/webV2/getOneArticle/' . urlencode($articleId);
    } else {
        $apiUrl = 'https://appworks.mpanel.app/api/webV2/getArticlesBySlug/' . urlencode($articleSlug);
    }

    if ($debug) {
        echo "<!-- DEBUG: API URL: " . $apiUrl . " -->\n";
    }

    $context = stream_context_create([
        'http' => [
            'header' => "Authorization: kmNTuI8dRmRX\r\n",
            'method' => 'GET',
            'timeout' => 30
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ]);

    $response = @file_get_contents($apiUrl, false, $context);

    if ($debug) {
        echo "<!-- DEBUG: Response received: " . ($response ? 'YES' : 'NO') . " -->\n";
    }

    if ($response) {
        $data = json_decode($response, true);

        if ($data && $data['success']) {
            // getArticlesBySlug returns article directly, getOneArticle returns in result.article
            if (isset($data['article']) && !empty($data['article'])) {
                $articleData = $data['article'];
            } elseif (isset($data['result']['article']) && !empty($data['result']['article'])) {
                $articleData = $data['result']['article'];
            } elseif (isset($data['result']['articles'][0]) && !empty($data['result']['articles'][0])) {
                $articleData = $data['result']['articles'][0];
            } elseif (isset($data['result'][0]) && !empty($data['result'][0])) {
                $articleData = $data['result'][0];
            }
        }
    }
}

// Update meta values if article found
if ($articleData) {
    $pageTitle = htmlspecialchars($articleData['title']) . " - Appworks";
    $pageDescription = htmlspecialchars($articleData['intro'] ?? $articleData['title']);

    // Handle image URL
    if (isset($articleData['images']['large-full']['url'])) {
        $pageImage = $articleData['images']['large-full']['url'];
    } elseif (isset($articleData['images']['medium-full']['url'])) {
        $pageImage = $articleData['images']['medium-full']['url'];
    } elseif (isset($articleData['media']['large-full'])) {
        $pageImage = $articleData['media']['large-full'];
    } elseif (isset($articleData['media']['medium-full'])) {
        $pageImage = $articleData['media']['medium-full'];
    }

    // Clean up image URL
    if ($pageImage && !filter_var($pageImage, FILTER_VALIDATE_URL)) {
        $pageImage = 'https://appworks.mpanel.app' . $pageImage;
    }

    // Create clean slug URL
    $cleanSlug = createSlug($articleData['title']);
    $pageUrl = "https://" . $_SERVER['HTTP_HOST'] . "/article.php?slug=" . $cleanSlug;
}

// Keywords
$keywords = "";
if ($articleData) {
    $categoryId = '';
    $categoryName = '';
    if (isset($articleData['categories'][0])) {
        $categoryId = $articleData['categories'][0]['id'] ?? '';
        $categoryName = $articleData['categories'][0]['name'] ?? '';
    } elseif (isset($articleData['category_id'])) {
        $categoryId = $articleData['category_id'];
    }

    $category = $categoryName ?: getCategoryName($categoryId);
    $keywords = htmlspecialchars($articleData['title']) . ", Appworks, " . $category;
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title><?php echo $pageTitle; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Appworks">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">

    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:title" content="<?php echo $pageTitle; ?>">
    <meta property="og:description" content="<?php echo $pageDescription; ?>">
    <meta property="og:image" content="<?php echo $pageImage; ?>">
    <meta property="og:url" content="<?php echo $pageUrl; ?>">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="Appworks">
    <meta property="og:logo" content="https://app-works.app/images/appworks.png">

    <!-- Twitter Card meta tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $pageTitle; ?>">
    <meta name="twitter:description" content="<?php echo $pageDescription; ?>">
    <meta name="twitter:image" content="<?php echo $pageImage; ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo $pageUrl; ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="https://app-works.app/images/appworks.png">
    <link rel="apple-touch-icon" href="https://app-works.app/images/appworks.png">

    <!-- Google Fonts: Inter Variable -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'royal-purple': {
                            900: '#200A24',
                            800: '#1A0624',
                            700: '#0F0520'
                        },
                        'vibrant-orange': {
                            500: '#FF4B36',
                            600: '#FF6B50'
                        },
                        'accent-purple': {
                            400: '#A78BFA',
                            500: '#8B5CF6',
                            600: '#7C3AED'
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'system-ui', '-apple-system', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Structured data for SEO -->
    <?php if ($articleData): ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "<?php echo addslashes($articleData['title']); ?>",
        "description": "<?php echo addslashes($articleData['intro'] ?? $articleData['title']); ?>",
        "image": "<?php echo $pageImage; ?>",
        "datePublished": "<?php echo $articleData['created_at']; ?>",
        "dateModified": "<?php echo $articleData['updated_at'] ?? $articleData['created_at']; ?>",
        "author": {
            "@type": "Organization",
            "name": "Appworks"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Appworks",
            "logo": {
                "@type": "ImageObject",
                "url": "https://app-works.app/images/appworks.png"
            }
        },
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?php echo $pageUrl; ?>"
        }
    }
    </script>
    <?php endif; ?>

    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background: #200A24;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            position: relative;
        }

        /* SVG Noise Texture Overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.03;
            z-index: 1;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        /* Animated Gradient Mesh Background */
        body::after {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 20% 50%, rgba(255, 75, 54, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(255, 107, 80, 0.1) 0%, transparent 50%);
            animation: gradientMesh 20s ease-in-out infinite;
        }

        @keyframes gradientMesh {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(10%, -10%) scale(1.1); }
            66% { transform: translate(-10%, 10%) scale(0.9); }
        }

        body > * {
            position: relative;
            z-index: 2;
        }

        /* Glassmorphism Base */
        .glass-light {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-medium {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(32px);
            -webkit-backdrop-filter: blur(32px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* Smooth Animations */
        .smooth-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Fixed Header */
        .header-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(32, 10, 36, 0.85);
            backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .header-nav.scrolled {
            background: rgba(32, 10, 36, 0.95);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
        }

        /* Mega Dropdown */
        .mega-dropdown {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(-10px);
            width: 900px;
            max-width: 90vw;
            background: rgba(32, 10, 36, 0.98);
            backdrop-filter: blur(32px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 2rem;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 48px rgba(0, 0, 0, 0.4);
        }

        .nav-item:hover .mega-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .mega-dropdown-item {
            padding: 1.25rem;
            border-radius: 0.75rem;
            transition: background 0.3s ease;
        }

        .mega-dropdown-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        /* Category Badge */
        .category-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            background: linear-gradient(135deg, #FF4B36 0%, #FF6B50 100%);
            color: white;
        }

        /* Back Button */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .back-button:hover {
            background: rgba(255, 75, 54, 0.1);
            border-color: rgba(255, 75, 54, 0.3);
            color: #FF6B50;
            transform: translateX(-4px);
        }

        /* Article Content Styles */
        .article-content {
            font-size: 1.125rem;
            line-height: 1.9;
            color: rgba(255, 255, 255, 0.85);
        }

        .article-content h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            margin: 2.5rem 0 1rem;
            letter-spacing: -0.01em;
        }

        .article-content h3 {
            font-size: 1.375rem;
            font-weight: 700;
            color: white;
            margin: 2rem 0 0.75rem;
            letter-spacing: -0.01em;
        }

        .article-content h4 {
            font-size: 1.125rem;
            font-weight: 700;
            color: white;
            margin: 1.5rem 0 0.5rem;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 1rem;
            margin: 2rem 0;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .article-content a {
            color: #FF6B50;
            text-decoration: underline;
            text-underline-offset: 2px;
            transition: color 0.3s ease;
        }

        .article-content a:hover {
            color: #FF4B36;
        }

        .article-content ul, .article-content ol {
            margin: 1.5rem 0;
            padding-left: 1.5rem;
        }

        .article-content li {
            margin-bottom: 0.75rem;
        }

        .article-content blockquote {
            margin: 2rem 0;
            padding: 1.5rem 2rem;
            border-left: 4px solid #FF4B36;
            background: rgba(255, 75, 54, 0.1);
            border-radius: 0 1rem 1rem 0;
            font-style: italic;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Featured Image */
        .featured-image {
            position: relative;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        .featured-image img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .featured-image img {
                height: 300px;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>

<!-- Fixed Header Navigation -->
<header class="header-nav">
    <div class="mx-auto px-6 lg:px-8" style="max-width: 1600px;">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/home.html" class="flex items-center">
                    <img src="https://app-works.app/images/appworks.png" alt="Appworks" class="h-12 w-auto">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="/home.html" class="text-white hover:text-vibrant-orange-600 font-bold text-lg transition-colors duration-300">Home</a>

                <!-- Solutions Dropdown -->
                <div class="nav-item relative group">
                    <button class="text-white hover:text-vibrant-orange-600 font-bold text-lg transition-colors duration-300 flex items-center gap-2">
                        Solutions
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>
                    <div class="mega-dropdown" style="width: 580px; max-width: 90vw;">
                        <div class="flex flex-col gap-3">
                            <a href="/cms.html" class="mega-dropdown-item block group/item">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background: rgba(255, 75, 54, 0.1);">
                                        <i class="bi bi-display text-vibrant-orange-600 text-2xl"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-white font-bold text-base mb-1">mPanel CMS</div>
                                        <div class="text-gray-400 text-sm leading-relaxed">Complete content management system for media publishers</div>
                                    </div>
                                    <i class="bi bi-arrow-right text-gray-500 text-lg transition-all duration-300 group-hover/item:text-vibrant-orange-600 group-hover/item:translate-x-1 flex-shrink-0"></i>
                                </div>
                            </a>
                            <div class="h-px bg-white/10"></div>
                            <a href="/media.html" class="mega-dropdown-item block group/item">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background: rgba(255, 75, 54, 0.1);">
                                        <i class="bi bi-newspaper text-vibrant-orange-600 text-2xl"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-white font-bold text-base mb-1">Media</div>
                                        <div class="text-gray-400 text-sm leading-relaxed">Digital publishing platforms and content delivery solutions</div>
                                    </div>
                                    <i class="bi bi-arrow-right text-gray-500 text-lg transition-all duration-300 group-hover/item:text-vibrant-orange-600 group-hover/item:translate-x-1 flex-shrink-0"></i>
                                </div>
                            </a>
                            <div class="h-px bg-white/10"></div>
                            <a href="/sport.html" class="mega-dropdown-item block group/item">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background: rgba(255, 75, 54, 0.1);">
                                        <i class="bi bi-trophy text-vibrant-orange-600 text-2xl"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-white font-bold text-base mb-1">Sport</div>
                                        <div class="text-gray-400 text-sm leading-relaxed">Fan engagement platforms and mobile apps for sports clubs</div>
                                    </div>
                                    <i class="bi bi-arrow-right text-gray-500 text-lg transition-all duration-300 group-hover/item:text-vibrant-orange-600 group-hover/item:translate-x-1 flex-shrink-0"></i>
                                </div>
                            </a>
                            <div class="h-px bg-white/10"></div>
                            <a href="https://litteraworks.com/" target="_blank" class="mega-dropdown-item block group/item">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background: rgba(139, 92, 246, 0.1);">
                                        <i class="bi bi-mic text-accent-purple-400 text-2xl"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-white font-bold text-base mb-1">Litteraworks</div>
                                        <div class="text-gray-400 text-sm leading-relaxed">AI-powered transcription and subtitle generation</div>
                                    </div>
                                    <i class="bi bi-arrow-right text-gray-500 text-lg transition-all duration-300 group-hover/item:text-accent-purple-400 group-hover/item:translate-x-1 flex-shrink-0"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="/consultation.html" class="text-white hover:text-vibrant-orange-600 font-bold text-lg transition-colors duration-300">Consultation</a>
                <a href="/projects.html" class="text-white hover:text-vibrant-orange-600 font-bold text-lg transition-colors duration-300">Grant Projects</a>
                <a href="/partners.html" class="text-white hover:text-vibrant-orange-600 font-bold text-lg transition-colors duration-300">Partners</a>
                <a href="/about.html" class="text-white hover:text-vibrant-orange-600 font-bold text-lg transition-colors duration-300">About Us</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="lg:hidden text-white p-2">
                <i class="bi bi-list text-2xl"></i>
            </button>
        </div>
    </div>
</header>

<!-- Article Header -->
<section class="pt-32 pb-8" style="background: #200A24;">
    <div class="mx-auto px-6 lg:px-8" style="max-width: 900px;">
        <!-- Back Button -->
        <a href="/articles.html" class="back-button mb-8 inline-flex">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Articles</span>
        </a>

        <?php if ($articleData): ?>
            <!-- Article Meta -->
            <div class="flex flex-wrap items-center gap-4 mb-6">
                <?php
                $displayCategory = '';
                if (isset($articleData['categories'][0]['name'])) {
                    $displayCategory = $articleData['categories'][0]['name'];
                } elseif (isset($articleData['categories'][0]['id'])) {
                    $displayCategory = getCategoryName($articleData['categories'][0]['id']);
                } elseif (isset($articleData['category_id'])) {
                    $displayCategory = getCategoryName($articleData['category_id']);
                }
                ?>
                <?php if ($displayCategory): ?>
                    <span class="category-badge"><?php echo htmlspecialchars($displayCategory); ?></span>
                <?php endif; ?>
                <span class="text-gray-400 text-sm">
                    <?php echo date('F j, Y', strtotime($articleData['created_at'])); ?>
                </span>
            </div>

            <!-- Article Title -->
            <h1 class="text-white font-black text-4xl lg:text-5xl mb-6" style="letter-spacing: -0.02em; line-height: 1.1;">
                <?php echo htmlspecialchars($articleData['title']); ?>
            </h1>

            <!-- Article Intro -->
            <?php if (!empty($articleData['intro'])): ?>
                <p class="text-gray-300 text-xl leading-relaxed" style="opacity: 0.85;">
                    <?php echo htmlspecialchars($articleData['intro']); ?>
                </p>
            <?php endif; ?>
        <?php else: ?>
            <h1 class="text-white font-black text-4xl lg:text-5xl mb-6" style="letter-spacing: -0.02em;">
                Article Not Found
            </h1>
            <p class="text-gray-400 text-xl">
                The requested article could not be found.
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- Featured Image -->
<?php if ($articleData && $pageImage !== 'https://app-works.app/images/appworks.png'): ?>
<section class="py-8" style="background: #200A24;">
    <div class="mx-auto px-6 lg:px-8" style="max-width: 1100px;">
        <div class="featured-image">
            <img src="<?php echo $pageImage; ?>?crop=true"
                 alt="<?php echo htmlspecialchars($articleData['title']); ?>"
                 onerror="this.style.display='none'">
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Article Content -->
<section class="py-12" style="background: #200A24;">
    <div class="mx-auto px-6 lg:px-8" style="max-width: 900px;">
        <div class="article-content">
            <?php
            if ($articleData) {
                $content = $articleData['body'] ?? $articleData['text'] ?? $articleData['contents'] ?? '';

                if ($content) {
                    // Decode HTML entities (mPanel stores content as HTML-encoded text)
                    $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');

                    // Fix image paths
                    $content = str_replace('/storage', 'https://appworks.mpanel.app/image/cache/extra-large', $content);

                    // Add crop=true parameter to images
                    $content = preg_replace('/(src="https:\/\/appworks\.mpanel\.app\/image\/cache\/extra-large[^"]*\.(jpg|jpeg|png|gif|bmp|svg|webp))(?!\?crop=true)"/i', '$1?crop=true"', $content);

                    echo $content;
                } else {
                    echo '<p class="text-gray-400">Article content is not available.</p>';
                }
            } else {
                echo '<p class="text-gray-400">Sorry, the article you are looking for does not exist or has been removed.</p>';
                echo '<a href="/articles.html" class="inline-flex items-center gap-2 mt-6 text-vibrant-orange-500 hover:text-vibrant-orange-600 font-semibold smooth-transition">';
                echo '<i class="bi bi-arrow-left"></i>';
                echo '<span>Browse all articles</span>';
                echo '</a>';
            }
            ?>
        </div>

        <?php if ($articleData): ?>
        <!-- Share Section -->
        <div class="mt-16 pt-8 border-t border-white/10">
            <h3 class="text-white font-bold text-lg mb-4">Share this article</h3>
            <div class="flex gap-3">
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($pageUrl); ?>&text=<?php echo urlencode($articleData['title']); ?>"
                   target="_blank"
                   class="flex items-center justify-center w-12 h-12 rounded-xl glass-light hover:bg-vibrant-orange-600/20 text-gray-400 hover:text-vibrant-orange-600 smooth-transition">
                    <i class="bi bi-twitter-x text-xl"></i>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pageUrl); ?>&title=<?php echo urlencode($articleData['title']); ?>"
                   target="_blank"
                   class="flex items-center justify-center w-12 h-12 rounded-xl glass-light hover:bg-vibrant-orange-600/20 text-gray-400 hover:text-vibrant-orange-600 smooth-transition">
                    <i class="bi bi-linkedin text-xl"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($pageUrl); ?>"
                   target="_blank"
                   class="flex items-center justify-center w-12 h-12 rounded-xl glass-light hover:bg-vibrant-orange-600/20 text-gray-400 hover:text-vibrant-orange-600 smooth-transition">
                    <i class="bi bi-facebook text-xl"></i>
                </a>
                <button onclick="navigator.clipboard.writeText('<?php echo $pageUrl; ?>'); this.innerHTML='<i class=\'bi bi-check text-xl\'></i>'; setTimeout(() => this.innerHTML='<i class=\'bi bi-link-45deg text-xl\'></i>', 2000);"
                        class="flex items-center justify-center w-12 h-12 rounded-xl glass-light hover:bg-vibrant-orange-600/20 text-gray-400 hover:text-vibrant-orange-600 smooth-transition">
                    <i class="bi bi-link-45deg text-xl"></i>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Footer -->
<footer class="relative py-20" style="background: rgba(0, 0, 0, 0.3); border-top: 1px solid rgba(255, 255, 255, 0.1);">
    <div class="mx-auto px-6 lg:px-8 mb-12" style="max-width: 1600px;">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Column 1: Logo & Social -->
            <div>
                <img src="https://app-works.app/images/appworks.png" alt="Appworks Logo" class="h-16 w-auto mb-4">
                <p class="text-gray-400 text-base leading-relaxed mb-6">Creative solutions for innovative partners.</p>
                <div class="flex gap-3">
                    <a href="https://www.linkedin.com/company/appworks-d-o-o/" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-lg smooth-transition glass-light hover:bg-vibrant-orange-600/20 text-gray-400 hover:text-vibrant-orange-600">
                        <i class="bi bi-linkedin text-xl"></i>
                    </a>
                    <a href="https://www.instagram.com/weareappworks/" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-lg smooth-transition glass-light hover:bg-vibrant-orange-600/20 text-gray-400 hover:text-vibrant-orange-600">
                        <i class="bi bi-instagram text-xl"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCydhgWA6Kg40T9EFmRVDb9A" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-lg smooth-transition glass-light hover:bg-vibrant-orange-600/20 text-gray-400 hover:text-vibrant-orange-600">
                        <i class="bi bi-youtube text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Column 2: Company -->
            <div>
                <h4 class="text-white font-bold text-base mb-6" style="letter-spacing: -0.01em;">Company</h4>
                <ul class="space-y-3">
                    <li><a href="/about.html" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">About us</a></li>
                    <li><a href="/partners.html" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">Partners</a></li>
                    <li><a href="/about.html" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">Contact us</a></li>
                </ul>
            </div>

            <!-- Column 3: Solutions -->
            <div>
                <h4 class="text-white font-bold text-base mb-6" style="letter-spacing: -0.01em;">Solutions</h4>
                <ul class="space-y-3">
                    <li><a href="/cms.html" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">CMS</a></li>
                    <li><a href="/media.html" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">Media</a></li>
                    <li><a href="/sport.html" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">Sports</a></li>
                    <li><a href="https://litteraworks.com" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">Litteraworks</a></li>
                    <li><a href="/consultation.html" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">Consultation</a></li>
                    <li><a href="/projects.html" class="text-gray-400 hover:text-vibrant-orange-600 smooth-transition text-sm">Grant Projects</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact -->
            <div>
                <h4 class="text-white font-bold text-base mb-6 flex items-center gap-2" style="letter-spacing: -0.01em;">
                    Contact us
                    <i class="bi bi-arrow-right text-vibrant-orange-600 text-sm"></i>
                </h4>
                <a href="mailto:info@app-works.app" class="text-white font-semibold text-sm hover:text-vibrant-orange-600 smooth-transition">info@app-works.app</a>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="pt-8 border-t border-white/10 text-center">
        <p class="text-gray-500 text-sm">&copy; 2026 Appworks. All rights reserved.</p>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scroll-to-top" class="fixed bottom-8 right-8 w-12 h-12 rounded-full items-center justify-center smooth-transition opacity-0 pointer-events-none" style="background: linear-gradient(135deg, #FF4B36 0%, #FF6B50 100%); box-shadow: 0 4px 12px rgba(255, 75, 54, 0.4); z-index: 999;">
    <i class="bi bi-arrow-up text-white text-xl"></i>
</button>

<script>
// Header scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.header-nav');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Scroll to top button
const scrollBtn = document.getElementById('scroll-to-top');
window.addEventListener('scroll', function() {
    if (window.scrollY > 500) {
        scrollBtn.style.opacity = '1';
        scrollBtn.style.pointerEvents = 'auto';
        scrollBtn.classList.add('flex');
    } else {
        scrollBtn.style.opacity = '0';
        scrollBtn.style.pointerEvents = 'none';
    }
});

scrollBtn.addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>

</body>
</html>
