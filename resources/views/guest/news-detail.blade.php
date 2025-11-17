<!-- resources/views/guest/news-detail.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $newsItem->title }} - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #05b4c7;      /* biru turquoise seperti tema kamu */
            --primary-dark: #0794a8;
            --primary-soft: #e0faff;
            --bg: #f4fbfc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --card-bg: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top left, #e0faff, #f9fafb 45%, #f1f5f9);
            color: var(--text-main);
            line-height: 1.6;
            margin: 0;
        }

        .page-shell {
            min-height: 100vh;
            padding: 32px 16px 48px;
        }

        .container {
            max-width: 1120px;
            margin: 0 auto;
        }

        /* Top bar / back */
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-dark);
            font-weight: 500;
            text-decoration: none;
            font-size: 0.95rem;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.9);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
            backdrop-filter: blur(10px);
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .back-button svg {
            width: 18px;
            height: 18px;
        }

        .back-button:hover {
            background: #ffffff;
            transform: translateX(-2px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .page-pill {
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.8rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
            border: 1px solid rgba(148, 163, 184, 0.3);
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(10px);
        }

        /* Main article card */
        .article-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.96), rgba(240,253,255,0.98));
            border-radius: 24px;
            padding: 32px 24px 32px;
            box-shadow:
                0 24px 60px rgba(15, 23, 42, 0.12),
                0 0 0 1px rgba(148, 163, 184, 0.16);
        }

        .article-header {
            max-width: 760px;
            margin: 0 auto 24px;
            text-align: center;
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 14px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .article-tag {
            background: linear-gradient(135deg, #e0faff, #dbeafe);
            color: var(--primary-dark);
            padding: 4px 14px;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.8rem;
            border: 1px solid rgba(56, 189, 248, 0.35);
        }

        .meta-dot {
            width: 4px;
            height: 4px;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.9);
        }

        .article-title {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .article-subtitle {
            font-size: 0.98rem;
            color: var(--text-muted);
        }

        /* Thumbnail image */
        .article-media-wrapper {
            margin: 28px auto 24px;
            max-width: 880px;
        }

        .article-image-shell {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            background: radial-gradient(circle at top, #e0faff, #bae6fd);
            box-shadow:
                0 22px 55px rgba(15, 23, 42, 0.30),
                0 0 0 1px rgba(15, 23, 42, 0.04);
        }

        .article-image {
            width: 100%;
            max-height: 520px;
            object-fit: cover;
            display: block;
        }

        .image-label {
            position: absolute;
            bottom: 14px;
            right: 16px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            background: rgba(15, 23, 42, 0.72);
            color: #e5f9ff;
            backdrop-filter: blur(10px);
        }

        /* Article content */
        .article-content {
            max-width: 760px;
            margin: 0 auto;
            font-size: 1.02rem;
            line-height: 1.9;
            color: #1f2937;
        }

        .article-content p {
            margin-bottom: 1.15rem;
        }

        .article-content h2,
        .article-content h3 {
            margin-top: 1.8rem;
            margin-bottom: 0.8rem;
            color: var(--text-main);
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 1.8rem auto;
            display: block;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.25);
        }

        /* Related section */
        .related-wrapper {
            margin-top: 40px;
        }

        .related-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 18px;
        }

        .related-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .related-caption {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .news-card {
            display: flex;
            flex-direction: column;
            background: rgba(255,255,255,0.96);
            border-radius: 18px;
            overflow: hidden;
            box-shadow:
                0 14px 35px rgba(15, 23, 42, 0.16),
                0 0 0 1px rgba(148, 163, 184, 0.22);
            text-decoration: none;
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
            border: 1px solid rgba(148, 163, 184, 0.18);
        }

        .news-card:hover {
            transform: translateY(-6px);
            box-shadow:
                0 22px 50px rgba(15, 23, 42, 0.28),
                0 0 0 1px rgba(56, 189, 248, 0.7);
        }

        .news-image-wrapper {
            position: relative;
            height: 160px;
            overflow: hidden;
        }

        .news-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transform: scale(1.03);
            transition: transform 0.25s ease;
        }

        .news-card:hover .news-image {
            transform: scale(1.08);
        }

        .news-chip {
            position: absolute;
            left: 12px;
            top: 12px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 0.7rem;
            background: rgba(15, 23, 42, 0.78);
            color: #e0faff;
        }

        .news-content {
            padding: 14px 16px 16px;
        }

        .news-date {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .news-title {
            font-weight: 600;
            font-size: 0.98rem;
            margin-bottom: 6px;
            color: var(--text-main);
        }

        .news-more {
            font-size: 0.85rem;
            color: var(--primary-dark);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .news-more svg {
            width: 14px;
            height: 14px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .article-card {
                padding: 24px 18px 26px;
            }
        }

        @media (max-width: 768px) {
            .page-shell {
                padding-top: 20px;
            }

            .top-bar {
                flex-direction: row;
                gap: 10px;
            }

            .article-title {
                font-size: 1.7rem;
            }

            .article-card {
                border-radius: 20px;
            }

            .article-media-wrapper {
                margin-top: 20px;
            }

            .news-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .news-grid {
                grid-template-columns: 1fr;
            }

            .article-title {
                font-size: 1.5rem;
            }

            .article-content {
                font-size: 0.98rem;
            }
        }
    </style>
</head>
<body>
<div class="page-shell">
    <div class="container">

        {{-- Top bar --}}
        <div class="top-bar">
            <a href="{{ route('guest.news') }}" class="back-button">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0 7-7M3 12h18"/>
                </svg>
                <span>Kembali ke Berita</span>
            </a>

            <div class="page-pill">
                Berita Sekolah · {{ $newsItem->published_date->format('d M Y') }}
            </div>
        </div>

        {{-- Article --}}
        <article class="article-card">
            <header class="article-header">
                <div class="article-meta">
                    <span class="article-tag">
                        {{ ucfirst($newsItem->category) }}
                    </span>
                    <span class="meta-dot"></span>
                    <span>{{ $newsItem->published_date->format('d F Y') }}</span>
                </div>
                <h1 class="article-title">{{ $newsItem->title }}</h1>
                <p class="article-subtitle">
                    Dokumentasi kegiatan dan informasi terbaru dari lingkungan sekolah.
                </p>
            </header>

            @if($newsItem->image)
                <div class="article-media-wrapper">
                    <div class="article-image-shell">
                        <img src="{{ asset('storage/' . $newsItem->image) }}"
                             alt="{{ $newsItem->title }}"
                             class="article-image">
                        <span class="image-label">Dokumentasi kegiatan</span>
                    </div>
                </div>
            @endif

            <div class="article-content">
                {!! $newsItem->content !!}
            </div>
        </article>

        {{-- Related news --}}
        @if($latestNews->count() > 0)
            <div class="related-wrapper">
                <div class="related-header">
                    <div>
                        <h2 class="related-title">Berita Lainnya</h2>
                        <p class="related-caption">Jelajahi informasi dan kegiatan terbaru dari sekolah.</p>
                    </div>
                </div>

                <div class="news-grid">
                    @foreach($latestNews as $news)
                        <a href="{{ route('guest.news.show', $news->slug) }}" class="news-card">
                            <div class="news-image-wrapper">
                                @if($news->image)
                                    <img src="{{ asset('storage/' . $news->image) }}"
                                         alt="{{ $news->title }}"
                                         class="news-image">
                                @else
                                    {{-- fallback tanpa gambar --}}
                                    <div class="news-image" style="background: linear-gradient(135deg,#0ea5e9,#14b8a6);"></div>
                                @endif
                                <span class="news-chip">{{ ucfirst($news->category) }}</span>
                            </div>
                            <div class="news-content">
                                <div class="news-date">{{ $news->published_date->format('d M Y') }}</div>
                                <h3 class="news-title">{{ $news->title }}</h3>
                                <span class="news-more">
                                    Lihat selengkapnya
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7"/>
                                    </path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
</body>
</html>
