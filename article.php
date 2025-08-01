<?php
// Debug mode - set to false in production
$debug = true;

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

// Function to create slug from title (identical to JavaScript version)
function createSlug($title) {
    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove special characters
    $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with hyphens
    $slug = preg_replace('/-+/', '-', $slug); // Replace multiple hyphens with single
    $slug = trim($slug, '-'); // Remove leading/trailing hyphens
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
        // Direct article fetch by ID
        $apiUrl = 'https://appworks.mpanel.app/api/webV2/getOneArticle/' . urlencode($articleId);
    } else {
        // Direct article fetch by slug
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
        if ($response) {
            echo "<!-- DEBUG: Response length: " . strlen($response) . " -->\n";
            echo "<!-- DEBUG: First 200 chars of response: " . substr($response, 0, 200) . " -->\n";
        } else {
            $error = error_get_last();
            echo "<!-- DEBUG: Error: " . ($error['message'] ?? 'Unknown error') . " -->\n";
        }
    }
    
    if ($response) {
        $data = json_decode($response, true);
        
        if ($debug) {
            echo "<!-- DEBUG: JSON decoded: " . ($data ? 'YES' : 'NO') . " -->\n";
            if ($data) {
                echo "<!-- DEBUG: Data success: " . ($data['success'] ? 'true' : 'false') . " -->\n";
                echo "<!-- DEBUG: Full API response structure: " . json_encode(array_keys($data)) . " -->\n";
                if (isset($data['result'])) {
                    echo "<!-- DEBUG: Result structure: " . json_encode(array_keys($data['result'])) . " -->\n";
                }
                echo "<!-- DEBUG: Articles count: " . (isset($data['result']['articles']) ? count($data['result']['articles']) : 0) . " -->\n";
                echo "<!-- DEBUG: Raw result (first 500 chars): " . substr(json_encode($data['result']), 0, 500) . " -->\n";
            }
        }
        
        if ($data && $data['success']) {
            if ($debug) {
                echo "<!-- DEBUG: FULL DATA DUMP: " . json_encode($data) . " -->\n";
            }
            
            // Both getOneArticle and getArticlesBySlug should return article in same format
            if (isset($data['result']['article'])) {
                $articleData = $data['result']['article'];
            } elseif (isset($data['result']['articles'][0])) {
                $articleData = $data['result']['articles'][0];
            } elseif (isset($data['result'][0])) {
                $articleData = $data['result'][0];
            }
            
            if ($debug) {
                echo "<!-- DEBUG: Found article: " . ($articleData ? 'YES' : 'NO') . " -->\n";
                if ($articleData) {
                    echo "<!-- DEBUG: Article title: " . ($articleData['title'] ?? 'NO TITLE') . " -->\n";
                }
            }
        }
    }
}

// Update meta values if article found
if ($articleData) {
    $pageTitle = htmlspecialchars($articleData['title']) . " - Appworks";
    $pageDescription = htmlspecialchars($articleData['intro'] ?? $articleData['title']);
    
    if ($debug) {
        echo "<!-- DEBUG: Article found! Title: " . $articleData['title'] . " -->\n";
        echo "<!-- DEBUG: Article intro: " . ($articleData['intro'] ?? 'none') . " -->\n";
        echo "<!-- DEBUG: Available fields: " . implode(', ', array_keys($articleData)) . " -->\n";
    }
    
    // Handle image URL
    if (isset($articleData['images']['large-full']['url'])) {
        $pageImage = $articleData['images']['large-full']['url'];
        if ($debug) echo "<!-- DEBUG: Using images[large-full][url] -->\n";
    } elseif (isset($articleData['images']['medium-full']['url'])) {
        $pageImage = $articleData['images']['medium-full']['url'];
        if ($debug) echo "<!-- DEBUG: Using images[medium-full][url] -->\n";
    } elseif (isset($articleData['media']['large-full'])) {
        $pageImage = $articleData['media']['large-full'];
        if ($debug) echo "<!-- DEBUG: Using media[large-full] -->\n";
    } elseif (isset($articleData['media']['medium-full'])) {
        $pageImage = $articleData['media']['medium-full'];
        if ($debug) echo "<!-- DEBUG: Using media[medium-full] -->\n";
    }
    
    if ($debug) {
        echo "<!-- DEBUG: Selected image: " . $pageImage . " -->\n";
    }
    
    // Clean up image URL
    if ($pageImage && !filter_var($pageImage, FILTER_VALIDATE_URL)) {
        $pageImage = 'https://appworks.mpanel.app' . $pageImage;
        if ($debug) echo "<!-- DEBUG: Fixed image URL: " . $pageImage . " -->\n";
    }
    
    // Create clean slug URL
    $cleanSlug = createSlug($articleData['title']);
    $pageUrl = "https://" . $_SERVER['HTTP_HOST'] . "/article.php?slug=" . $cleanSlug;
    
    if ($debug) {
        echo "<!-- DEBUG: Final title: " . $pageTitle . " -->\n";
        echo "<!-- DEBUG: Final description: " . $pageDescription . " -->\n";
        echo "<!-- DEBUG: Final image: " . $pageImage . " -->\n";
        echo "<!-- DEBUG: Final URL: " . $pageUrl . " -->\n";
    }
}

// Keywords
$keywords = "";
if ($articleData) {
    $category = getCategoryName($articleData['category_id'] ?? '');
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
        
        <!-- Twitter Card meta tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo $pageTitle; ?>">
        <meta name="twitter:description" content="<?php echo $pageDescription; ?>">
        <meta name="twitter:image" content="<?php echo $pageImage; ?>">
        
        <!-- Canonical URL -->
        <link rel="canonical" href="<?php echo $pageUrl; ?>">
        
        <!-- favicon icon -->
        <link rel="shortcut icon" href="https://app-works.app/images/appworks.png">
        <link rel="apple-touch-icon" href="https://app-works.app/images/appworks.png">
        
        <!-- style sheets and font icons -->
        <link rel="stylesheet" href="https://app-works.app/css/vendors.min.css"/>
        <link rel="stylesheet" href="https://app-works.app/css/icon.min.css"/>
        <link rel="stylesheet" href="https://app-works.app/css/style.css"/>
        <link rel="stylesheet" href="https://app-works.app/css/responsive.css"/>
        
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
                    "url": "https://app-works.app//images/appworks.png"
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
            .article-header {
                background: #200A24;
                padding: 120px 0 80px;
            }
            .article-content {
                padding: 80px 0;
            }
            .article-meta {
                display: flex;
                align-items: center;
                gap: 20px;
                margin-bottom: 30px;
                flex-wrap: wrap;
            }
            .article-category {
                background: #FF4B36;
                color: white;
                padding: 5px 15px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
            }
            .article-date {
                color: #ccc;
                font-size: 14px;
            }
            .article-featured-image {
                margin-bottom: 40px;
                border-radius: 12px;
                overflow: hidden;
            }
            .article-featured-image img {
                width: 100%;
                height: 400px;
                object-fit: cover;
            }
            .article-body {
                font-size: 18px;
                line-height: 1.8;
                color: #333;
            }
            .article-body h2, .article-body h3, .article-body h4 {
                margin: 40px 0 20px;
                color: #200A24;
            }
            .article-body p {
                margin-bottom: 25px;
            }
            .article-body img {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
                margin: 30px 0;
            }
            .back-button {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                color: #FF4B36;
                text-decoration: none;
                font-weight: 600;
                margin-bottom: 30px;
                transition: all 0.3s ease;
            }
            .back-button:hover {
                color: #200A24;
                transform: translateX(-5px);
            }
            @media (max-width: 768px) {
                .article-header {
                    padding: 100px 0 60px;
                }
                .article-content {
                    padding: 60px 0;
                }
                .article-featured-image img {
                    height: 250px;
                }
                .article-body {
                    font-size: 16px;
                }
            }
        </style>
    </head>
    <body data-mobile-nav-style="full-screen-menu" data-mobile-nav-bg-color="#252840">
        <!-- Same header as article.html -->
        <header>
            <nav class="navbar navbar-expand-lg header-transparent bg-transparent header-reverse glass-effect" data-header-hover="light">
                <div class="container-fluid">
                    <div class="col-auto col-xxl-3 col-lg-2 me-lg-0 me-auto">
                        <a class="navbar-brand" href="home.html">
                            <img src="https://app-works.app//images/appworks.png" data-at2x="https://app-works.app//images/appworks.png" alt="Appworks Logo" class="default-logo">
                            <img src="https://app-works.app//images/appworks-black.png" data-at2x="https://app-works.app//images/appworks-black.png" alt="Appworks Logo" class="alt-logo">
                            <img src="https://app-works.app//images/appworks.png" data-at2x="https://app-works.app//images/appworks.png" alt="Appworks Logo" class="mobile-logo">
                        </a>
                    </div>
                    <div class="col-auto col-xxl-6 col-lg-8 menu-order position-static">
                        <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav d-flex justify-content-between w-100" style="max-width: 1400px; padding: 0 15px; margin-left: 50px;">
                                <li class="nav-item" style="margin: 0 10px;"><a href="home.html" class="nav-link">Home</a></li>
                                <li class="nav-item" style="margin: 0 10px;"><a href="cms.html" class="nav-link">AI&nbsp;CMS</a></li>
                                <li class="nav-item" style="margin: 0 10px;"><a href="media.html" class="nav-link">Media</a></li>
                                <li class="nav-item" style="margin: 0 10px;"><a href="sport.html" class="nav-link">Sport</a></li>
                                <li class="nav-item" style="margin: 0 10px;"><a href="https://litteraworks.com/" class="nav-link" target="_blank">Litteraworks</a></li>
                                <li class="nav-item" style="margin: 0 10px;"><a href="projects.html" class="nav-link">Grant&nbsp;Projects</a></li>
                                <li class="nav-item" style="margin: 0 10px;"><a href="partners.html" class="nav-link">Partners</a></li>
                                <li class="nav-item" style="margin: 0 10px;"><a href="about.html" class="nav-link">About&nbsp;Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Article Header -->
        <section class="article-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <a href="javascript:history.back()" class="back-button">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back to Articles
                        </a>
                        <div class="article-meta">
                            <?php if ($articleData): ?>
                                <span class="article-category"><?php echo getCategoryName($articleData['category_id'] ?? ''); ?></span>
                                <span class="article-date"><?php echo date('F j, Y', strtotime($articleData['created_at'])); ?></span>
                            <?php endif; ?>
                        </div>
                        <h1 class="text-white fw-600 ls-minus-2px mb-3">
                            <?php echo $articleData ? htmlspecialchars($articleData['title']) : 'Article Not Found'; ?>
                        </h1>
                        <p class="text-white opacity-8 fs-18">
                            <?php echo $articleData ? htmlspecialchars($articleData['intro'] ?? '') : 'The requested article could not be found.'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Article Content -->
        <section class="article-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <?php if ($articleData && $pageImage !== 'https://app-works.app//images/appworks.png'): ?>
                        <div class="article-featured-image">
                            <img src="<?php echo $pageImage; ?>" alt="<?php echo htmlspecialchars($articleData['title']); ?>" />
                        </div>
                        <?php endif; ?>
                        
                        <div class="article-body">
                            <?php 
                            if ($articleData) {
                                // Debug what fields are available
                                if ($debug) {
                                    echo "<!-- DEBUG: Article data keys: " . implode(', ', array_keys($articleData)) . " -->\n";
                                    echo "<!-- DEBUG: Content fields - body: " . (isset($articleData['body']) ? 'EXISTS' : 'MISSING') . ", text: " . (isset($articleData['text']) ? 'EXISTS' : 'MISSING') . ", contents: " . (isset($articleData['contents']) ? 'EXISTS' : 'MISSING') . " -->\n";
                                }
                                
                                // Get content - try body, text, contents (same order as article.html)
                                $content = $articleData['body'] ?? $articleData['text'] ?? $articleData['contents'] ?? '';
                                
                                if ($content) {
                                    // Fix image paths (same as article.html)
                                    $content = str_replace('/storage', 'https://appworks.mpanel.app/image/cache/extra-large', $content);
                                    
                                    // Add crop=true parameter to images
                                    $content = preg_replace('/(src="https:\/\/appworks\.mpanel\.app\/image\/cache\/extra-large[^"]*\.(jpg|jpeg|png|gif|bmp|svg|webp))(?!\?crop=true)"/i', '$1?crop=true"', $content);
                                    
                                    // Display intro if available
                                    if (!empty($articleData['intro'])) {
                                        echo '<div class="article-intro mb-4">';
                                        echo '<p class="fs-18 lh-32 text-dark-gray">' . htmlspecialchars($articleData['intro']) . '</p>';
                                        echo '</div>';
                                    }
                                    
                                    // Display main content
                                    echo '<div class="article-text">';
                                    echo $content;
                                    echo '</div>';
                                } else {
                                    if ($debug) {
                                        echo "<!-- DEBUG: No content found in body, text, or contents fields -->\n";
                                    }
                                    echo '<p>Article content is not available.</p>';
                                }
                            } else {
                                echo '<p>Sorry, the article you are looking for does not exist or has been removed.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Same footer as article.html -->
        <footer class="p-0 footer-light position-relative">
            <div class="container position-relative">
                <div class="row justify-content-center pt-5 sm-pt-40px">
                    <div class="col-6 col-xl-3 col-lg-12 col-sm-6 last-paragraph-no-margin text-xl-start text-lg-center order-sm-1 lg-mb-60px sm-mb-40px">
                        <a href="home.html" class="footer-logo mb-15px d-inline-block">
                            <img src="https://app-works.app//images/appworks-black - 114x114.png" data-at2x="https://app-works.app//images/appworks-black - 114x114.png" alt="Appworks Logo">
                        </a>
                        <p class="lh-28 w-90 xl-w-100 mx-lg-auto mx-xl-0">Creative solutions for innovative partners.</p>
                        <div class="elements-social social-icon-style-02 mt-15px">
                            <ul class="medium-icon dark">
                                <li class="my-0"><a class="linkedin" href="https://www.linkedin.com/company/appworks-d-o-o/" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                                <li class="my-0"><a class="instagram" href="https://www.instagram.com/weareappworks/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="my-0"><a class="youtube" href="https://www.youtube.com/channel/UCydhgWA6Kg40T9EFmRVDb9A" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 col-xl-2 col-lg-3 col-sm-4 xs-mb-30px order-sm-3 order-lg-2">
                        <span class="fw-600 d-block text-dark-gray mb-5px">Company</span>
                        <ul>
                            <li><a href="about.html">About us</a></li>
                            <li><a href="partners.html">Partners</a></li>
                            <li><a href="about.html">Contact us</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-xl-2 col-lg-3 col-md-5 col-sm-4 xs-mb-30px order-sm-4 order-lg-3">
                        <span class="fw-600 d-block text-dark-gray mb-5px">Solutions</span>
                        <ul>
                            <li><a href="cms.html">CMS</a></li>
                            <li><a href="media.html">Media</a></li>
                            <li><a href="sport.html">Sports</a></li>
                            <li><a href="https://litteraworks.com">Litteraworks</a></li>
                            <li><a href="projects.html">Grant Projects</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-xl-2 col-lg-3 col-md-3 col-sm-4 xs-mb-30px order-sm-5 order-lg-4">
                        <span class="fw-600 d-block text-dark-gray mb-5px">Contact us</span>
                        <a href="mailto:info@app-works.app" class="text-dark-gray fw-600">info@app-works.app</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- javascript libraries -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/vendors.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>