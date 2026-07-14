<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: ../frontend/auth/login.html");
    exit();
}

$user_id = (int) $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE User_id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$username = $user["Username"] ?? "User";
$initial = strtoupper(substr($username, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZamaBook</title>
    <link rel="stylesheet" href="../frontend/css/feed.css">
</head>
<body class="feed-page">

    <!-- Top Navigation -->
    <header class="fb-nav">
        <div class="fb-nav__left">
            <a href="feed.php" class="fb-logo" title="ZamaBook">z</a>
            <div class="fb-search">
                <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M15.1 14.3l-3.7-3.7c.9-1.1 1.4-2.5 1.4-4 0-3.4-2.8-6.1-6.1-6.1S.6 3.2.6 6.6s2.8 6.1 6.1 6.1c1.5 0 2.9-.5 4-1.4l3.7 3.7c.2.2.5.2.7 0l.2-.2c.2-.2.2-.5-.2-.5zM6.7 11.5c-2.7 0-4.9-2.2-4.9-4.9s2.2-4.9 4.9-4.9 4.9 2.2 4.9 4.9-2.2 4.9-4.9 4.9z"/></svg>
                <input type="text" placeholder="Search ZamaBook" aria-label="Search">
            </div>
        </div>

        <nav class="fb-nav__center" aria-label="Main">
            <a href="feed.php" class="nav-tab active" title="Home">
                <svg viewBox="0 0 28 28"><path d="M25.8 10.5l-11.2-8.1a1.5 1.5 0 00-1.7 0L1.7 10.5a1 1 0 00.6 1.8h1.8v11.2A2.5 2.5 0 006.6 26h4.2v-7.5h6.4V26h4.2a2.5 2.5 0 002.5-2.5V12.3h1.8a1 1 0 00.6-1.8z"/></svg>
            </a>
            <a href="#" class="nav-tab" title="Friends">
                <svg viewBox="0 0 28 28"><path d="M10.5 14.5a5 5 0 100-10 5 5 0 000 10zm0 2.5c-4.1 0-7.5 2.4-7.5 5.4V25h15v-2.6c0-3-3.4-5.4-7.5-5.4zm10.2-2.5a3.8 3.8 0 100-7.5 3.8 3.8 0 000 7.5zm0 1.9c-2.6 0-5 1.3-5.8 3.1 1.9.7 3.5 2 4.3 3.5h7.7v-1.5c0-2.3-2.8-5.1-6.2-5.1z"/></svg>
            </a>
            <a href="#" class="nav-tab" title="Watch">
                <svg viewBox="0 0 28 28"><path d="M14 2.5C7.6 2.5 2.5 7.6 2.5 14S7.6 25.5 14 25.5 25.5 20.4 25.5 14 20.4 2.5 14 2.5zm4.3 12.4l-6.2 3.8a1 1 0 01-1.5-.9v-7.6a1 1 0 011.5-.9l6.2 3.8a1 1 0 010 1.8z"/></svg>
            </a>
            <a href="#" class="nav-tab" title="Marketplace">
                <svg viewBox="0 0 28 28"><path d="M23.5 10l-1.3-5.8A2.5 2.5 0 0019.8 2.5H8.2a2.5 2.5 0 00-2.4 1.7L4.5 10H2v2.5h1.2l1.3 11a2.5 2.5 0 002.5 2.2h14a2.5 2.5 0 002.5-2.2l1.3-11H26V10h-2.5zM8.2 5h11.6l1 4.5H7.2l1-4.5zM20 23.2H8l-1.2-10.7h14.4L20 23.2z"/></svg>
            </a>
            <a href="#" class="nav-tab" title="Groups">
                <svg viewBox="0 0 28 28"><path d="M14 11.5a4 4 0 100-8 4 4 0 000 8zm-7.5 1.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7zm15 0a3.5 3.5 0 100-7 3.5 3.5 0 000 7zM14 14c-3.9 0-7 2.5-7 5.5V22h14v-2.5c0-3-3.1-5.5-7-5.5zm-9.5.5c-2.2.3-4 2-4 4.5V22h4.5v-2.5c0-1.5.5-2.8 1.3-3.8-.6-.1-1.2-.2-1.8-.2zm19 0c-.6 0-1.2.1-1.8.2.8 1 1.3 2.3 1.3 3.8V22H28v-2.5c0-2.5-1.8-4.2-4-4.5z"/></svg>
            </a>
        </nav>

        <div class="fb-nav__right">
            <button class="nav-icon-btn" type="button" title="Menu" aria-label="Menu">
                <svg viewBox="0 0 20 20"><path d="M10 14a4 4 0 100-8 4 4 0 000 8zm-7.5-3.5h3a1 1 0 010 2h-3a1 1 0 010-2zm12 0h3a1 1 0 010 2h-3a1 1 0 010-2zM10 2a1 1 0 011 1v3a1 1 0 01-2 0V3a1 1 0 011-1zm0 12a1 1 0 011 1v3a1 1 0 01-2 0v-3a1 1 0 011-1z"/></svg>
            </button>
            <button class="nav-icon-btn" type="button" title="Messenger" aria-label="Messenger">
                <svg viewBox="0 0 20 20"><path d="M10 1.5C5 1.5 1.5 5.2 1.5 10c0 2.6 1.3 4.9 3.3 6.4v2.1l2.4-1.3c.9.3 1.8.4 2.8.4 5 0 8.5-3.7 8.5-8.5S15 1.5 10 1.5zm.9 10.2l-2.2-2.3-4.2 2.3 4.6-4.9 2.2 2.3 4.2-2.3-4.6 4.9z"/></svg>
            </button>
            <button class="nav-icon-btn" type="button" title="Notifications" aria-label="Notifications">
                <svg viewBox="0 0 20 20"><path d="M10 18.5a2 2 0 002-2H8a2 2 0 002 2zm6.5-5.5V9a6.5 6.5 0 00-5-6.3V2a1.5 1.5 0 00-3 0v.7A6.5 6.5 0 003.5 9v4L2 14.5V16h16v-1.5L16.5 13z"/></svg>
            </button>
            <a href="#" class="nav-avatar av-1" title="<?php echo htmlspecialchars($username); ?>">
                <?php echo htmlspecialchars($initial); ?>
            </a>
            <a href="auth/logout.php" class="nav-icon-btn" title="Log out" aria-label="Log out">
                <svg viewBox="0 0 20 20"><path d="M8 3H4a2 2 0 00-2 2v10a2 2 0 002 2h4a1 1 0 010 2H4a4 4 0 01-4-4V5a4 4 0 014-4h4a1 1 0 010 2zm9.7 6.3l-3-3a1 1 0 10-1.4 1.4L14.6 9H8a1 1 0 000 2h6.6l-1.3 1.3a1 1 0 101.4 1.4l3-3a1 1 0 000-1.4z"/></svg>
            </a>
        </div>
    </header>

    <div class="fb-layout">

        <!-- Left Sidebar -->
        <aside class="fb-left">
            <a href="profile.php" class="side-item">
                <span class="side-item__icon side-item__icon--avatar av-1"><?php echo htmlspecialchars($initial); ?></span>
                <span><?php echo htmlspecialchars($username); ?> </span>
            </a>
            <a href="#" class="side-item">
                <span class="side-item__icon" style="background:#e7f3ff;color:#1877f2;">👥</span>
                <span>Friends</span>
            </a>
            <a href="#" class="side-item">
                <span class="side-item__icon" style="background:#fff0e8;">📅</span>
                <span>Memories</span>
            </a>
            <a href="#" class="side-item">
                <span class="side-item__icon" style="background:#e7f3ff;">💾</span>
                <span>Saved</span>
            </a>
            <a href="#" class="side-item">
                <span class="side-item__icon" style="background:#f0e6ff;">👥</span>
                <span>Groups</span>
            </a>
            <a href="#" class="side-item">
                <span class="side-item__icon" style="background:#fff8e6;">📺</span>
                <span>Video</span>
            </a>
            <a href="#" class="side-item">
                <span class="side-item__icon" style="background:#e8f5e9;">🛒</span>
                <span>Marketplace</span>
            </a>
            <a href="#" class="side-item">
                <span class="side-item__icon" style="background:#e4e6eb;border-radius:50%;">⌃</span>
                <span>See more</span>
            </a>

            <div class="side-divider"></div>
            <p class="side-section-title">Your shortcuts</p>
            <a href="#" class="side-item">
                <span class="side-item__icon side-item__icon--color" style="background:linear-gradient(45deg,#f09433,#e6683c,#dc2743);color:white;font-size:14px;font-weight:700;">IG</span>
                <span>Design Community</span>
            </a>
            <a href="#" class="side-item">
                <span class="side-item__icon side-item__icon--color" style="background:#1877f2;color:white;font-size:14px;font-weight:700;">ZB</span>
                <span>ZamaBook Devs</span>
            </a>

            <div class="side-footer">
                <a href="#">Privacy</a> · <a href="#">Terms</a> · <a href="#">Advertising</a> ·
                <a href="#">Cookies</a> · ZamaBook © 2026
            </div>
        </aside>

        <!-- Main Feed -->
        <main class="fb-main">

            <!-- Stories -->
            <section class="fb-card stories" aria-label="Stories">
                <div class="story story__create">
                    <div class="story__create-bg"></div>
                    <span class="story__create-btn">+</span>
                    <span class="story__create-label">Create story</span>
                </div>
                <div class="story">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=300&h=500&fit=crop" alt="">
                    <div class="story__avatar"><img src="https://i.pravatar.cc/80?img=12" alt=""></div>
                    <span class="story__name">Alex Chen</span>
                </div>
                <div class="story">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=300&h=500&fit=crop" alt="">
                    <div class="story__avatar"><img src="https://i.pravatar.cc/80?img=5" alt=""></div>
                    <span class="story__name">Sara Khan</span>
                </div>
                <div class="story">
                    <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=300&h=500&fit=crop" alt="">
                    <div class="story__avatar"><img src="https://i.pravatar.cc/80?img=33" alt=""></div>
                    <span class="story__name">Mike Torres</span>
                </div>
                <div class="story">
                    <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=300&h=500&fit=crop" alt="">
                    <div class="story__avatar"><img src="https://i.pravatar.cc/80?img=47" alt=""></div>
                    <span class="story__name">Emma Lee</span>
                </div>
            </section>

            <!-- Create Post -->
            <section class="fb-card create-post">
                <div class="create-post__top">
                    <span class="nav-avatar av-1"><?php echo htmlspecialchars($initial); ?></span>
                    <button class="create-post__trigger" type="button">
                        What's on your mind, <?php echo htmlspecialchars($username); ?>?
                    </button>
                </div>
                <div class="create-post__actions">
                    <button class="create-action" type="button">
                        <svg viewBox="0 0 24 24" fill="#f3425f"><path d="M17 10.5V7a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 001-1v-3.5l4 4v-11l-4 4z"/></svg>
                        <span>Live video</span>
                    </button>
                    <button class="create-action" type="button">
                        <svg viewBox="0 0 24 24" fill="#45bd62"><path d="M21 19V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                        <span>Photo/video</span>
                    </button>
                    <button class="create-action" type="button">
                        <svg viewBox="0 0 24 24" fill="#f7b928"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" opacity="0"/><circle cx="12" cy="12" r="10" fill="none"/><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm-1.5 14.5l-4-4 1.4-1.4 2.6 2.6 5.6-5.6 1.4 1.4-7 7z"/></svg>
                        <span>Feeling/activity</span>
                    </button>
                </div>
            </section>

            <!-- Post 1 -->
            <article class="fb-card post">
                <div class="post__header">
                    <span class="nav-avatar av-2">A</span>
                    <div class="post__info">
                        <a href="#" class="post__author">Alex Chen</a>
                        <div class="post__meta">
                            <span>2 h</span> ·
                            <svg viewBox="0 0 16 16"><path d="M8 1a7 7 0 100 14A7 7 0 008 1zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z"/></svg>
                        </div>
                    </div>
                    <button class="post__more" type="button" aria-label="More">···</button>
                </div>
                <div class="post__body">Just finished a weekend hike — the views were unreal. Who else is outdoors this week?</div>
                <img class="post__image" src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=500&fit=crop" alt="Mountain landscape">
                <div class="post__stats">
                    <div class="post__likes">
                        <div class="reaction-icons">
                            <span class="reaction reaction--like">👍</span>
                            <span class="reaction reaction--love">❤️</span>
                        </div>
                        <span>248</span>
                    </div>
                    <div>36 comments · 12 shares</div>
                </div>
                <div class="post__actions">
                    <button class="post-action liked" type="button">
                        <svg viewBox="0 0 24 24"><path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.3a2 2 0 002-1.7l1.4-9A2 2 0 0019.7 9H14zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3v11z"/></svg>
                        <span>Like</span>
                    </button>
                    <button class="post-action" type="button">
                        <svg viewBox="0 0 24 24"><path d="M21 6h-2v9H6v2c0 .6.5 1 1 1h11l4 4V7c0-.6-.5-1-1-1zm-4 6V3c0-.6-.5-1-1-1H3c-.6 0-1 .5-1 1v14l4-4h10c.6 0 1-.5 1-1z"/></svg>
                        <span>Comment</span>
                    </button>
                    <button class="post-action" type="button">
                        <svg viewBox="0 0 24 24"><path d="M18 16.1c-.8 0-1.4.3-2 .8l-7.1-4.1c.1-.3.1-.5.1-.8s0-.5-.1-.8L16 7.2c.5.5 1.2.8 2 .8 1.7 0 3-1.3 3-3s-1.3-3-3-3-3 1.3-3 3c0 .3 0 .5.1.8L8 11.9c-.5-.5-1.2-.8-2-.8-1.7 0-3 1.3-3 3s1.3 3 3 3c.8 0 1.5-.3 2-.8l7.1 4.1c-.1.3-.1.5-.1.8 0 1.7 1.3 3 3 3s3-1.3 3-3-1.3-3-3-3z"/></svg>
                        <span>Share</span>
                    </button>
                </div>
            </article>

            <!-- Post 2 -->
            <article class="fb-card post">
                <div class="post__header">
                    <span class="nav-avatar av-3">S</span>
                    <div class="post__info">
                        <a href="#" class="post__author">Sara Khan</a>
                        <div class="post__meta">
                            <span>5 h</span> ·
                            <svg viewBox="0 0 16 16"><path d="M8 1a7 7 0 100 14A7 7 0 008 1zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z"/></svg>
                        </div>
                    </div>
                    <button class="post__more" type="button" aria-label="More">···</button>
                </div>
                <div class="post__body">New coffee shop downtown is a must-try. The latte art alone was worth the visit.</div>
                <img class="post__image" src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&h=500&fit=crop" alt="Coffee">
                <div class="post__stats">
                    <div class="post__likes">
                        <div class="reaction-icons">
                            <span class="reaction reaction--like">👍</span>
                            <span class="reaction reaction--love">❤️</span>
                        </div>
                        <span>89</span>
                    </div>
                    <div>14 comments · 3 shares</div>
                </div>
                <div class="post__actions">
                    <button class="post-action" type="button">
                        <svg viewBox="0 0 24 24"><path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.3a2 2 0 002-1.7l1.4-9A2 2 0 0019.7 9H14zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3v11z"/></svg>
                        <span>Like</span>
                    </button>
                    <button class="post-action" type="button">
                        <svg viewBox="0 0 24 24"><path d="M21 6h-2v9H6v2c0 .6.5 1 1 1h11l4 4V7c0-.6-.5-1-1-1zm-4 6V3c0-.6-.5-1-1-1H3c-.6 0-1 .5-1 1v14l4-4h10c.6 0 1-.5 1-1z"/></svg>
                        <span>Comment</span>
                    </button>
                    <button class="post-action" type="button">
                        <svg viewBox="0 0 24 24"><path d="M18 16.1c-.8 0-1.4.3-2 .8l-7.1-4.1c.1-.3.1-.5.1-.8s0-.5-.1-.8L16 7.2c.5.5 1.2.8 2 .8 1.7 0 3-1.3 3-3s-1.3-3-3-3-3 1.3-3 3c0 .3 0 .5.1.8L8 11.9c-.5-.5-1.2-.8-2-.8-1.7 0-3 1.3-3 3s1.3 3 3 3c.8 0 1.5-.3 2-.8l7.1 4.1c-.1.3-.1.5-.1.8 0 1.7 1.3 3 3 3s3-1.3 3-3-1.3-3-3-3z"/></svg>
                        <span>Share</span>
                    </button>
                </div>
            </article>

            <!-- Post 3 (text only) -->
            <article class="fb-card post">
                <div class="post__header">
                    <span class="nav-avatar av-4">M</span>
                    <div class="post__info">
                        <a href="#" class="post__author">Mike Torres</a>
                        <div class="post__meta">
                            <span>Yesterday</span> ·
                            <svg viewBox="0 0 16 16"><path d="M8 1a7 7 0 100 14A7 7 0 008 1zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z"/></svg>
                        </div>
                    </div>
                    <button class="post__more" type="button" aria-label="More">···</button>
                </div>
                <div class="post__body">Excited to announce I started learning PHP and building my first social app. Small steps, big dreams!</div>
                <div class="post__stats">
                    <div class="post__likes">
                        <div class="reaction-icons">
                            <span class="reaction reaction--like">👍</span>
                        </div>
                        <span>42</span>
                    </div>
                    <div>8 comments · 1 share</div>
                </div>
                <div class="post__actions">
                    <button class="post-action" type="button">
                        <svg viewBox="0 0 24 24"><path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.3a2 2 0 002-1.7l1.4-9A2 2 0 0019.7 9H14zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3v11z"/></svg>
                        <span>Like</span>
                    </button>
                    <button class="post-action" type="button">
                        <svg viewBox="0 0 24 24"><path d="M21 6h-2v9H6v2c0 .6.5 1 1 1h11l4 4V7c0-.6-.5-1-1-1zm-4 6V3c0-.6-.5-1-1-1H3c-.6 0-1 .5-1 1v14l4-4h10c.6 0 1-.5 1-1z"/></svg>
                        <span>Comment</span>
                    </button>
                    <button class="post-action" type="button">
                        <svg viewBox="0 0 24 24"><path d="M18 16.1c-.8 0-1.4.3-2 .8l-7.1-4.1c.1-.3.1-.5.1-.8s0-.5-.1-.8L16 7.2c.5.5 1.2.8 2 .8 1.7 0 3-1.3 3-3s-1.3-3-3-3-3 1.3-3 3c0 .3 0 .5.1.8L8 11.9c-.5-.5-1.2-.8-2-.8-1.7 0-3 1.3-3 3s1.3 3 3 3c.8 0 1.5-.3 2-.8l7.1 4.1c-.1.3-.1.5-.1.8 0 1.7 1.3 3 3 3s3-1.3 3-3-1.3-3-3-3z"/></svg>
                        <span>Share</span>
                    </button>
                </div>
            </article>

        </main>

        <!-- Right Sidebar -->
        <aside class="fb-right">
            <div class="sponsored">
                <p class="sponsored__title">Sponsored</p>
                <a href="#" class="sponsored__card">
                    <img class="sponsored__img" src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=200&h=200&fit=crop" alt="">
                    <div class="sponsored__text">
                        <h4>Upgrade your phone</h4>
                        <p>techdeals.example</p>
                    </div>
                </a>
                <a href="#" class="sponsored__card">
                    <img class="sponsored__img" src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=200&h=200&fit=crop" alt="">
                    <div class="sponsored__text">
                        <h4>Smart watches on sale</h4>
                        <p>wearables.example</p>
                    </div>
                </a>
            </div>

            <div class="side-divider"></div>

            <div class="contacts-header">
                <h3>Contacts</h3>
                <div class="contacts-tools">
                    <button type="button" title="Search" aria-label="Search contacts">🔍</button>
                    <button type="button" title="Options" aria-label="Options">···</button>
                </div>
            </div>

            <a href="#" class="contact">
                <span class="contact__avatar av-2">A<span class="contact__online"></span></span>
                <span>Alex Chen</span>
            </a>
            <a href="#" class="contact">
                <span class="contact__avatar av-3">S<span class="contact__online"></span></span>
                <span>Sara Khan</span>
            </a>
            <a href="#" class="contact">
                <span class="contact__avatar av-4">M<span class="contact__online"></span></span>
                <span>Mike Torres</span>
            </a>
            <a href="#" class="contact">
                <span class="contact__avatar av-5">E</span>
                <span>Emma Lee</span>
            </a>
            <a href="#" class="contact">
                <span class="contact__avatar av-6">J<span class="contact__online"></span></span>
                <span>Jordan Blake</span>
            </a>
        </aside>

    </div>

</body>
</html>
