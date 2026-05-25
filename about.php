<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>О нас — Магистраль Р-217</title>
  <meta name="description" content="О компании ООО «Магистраль Р-217» — история, ценности и реализованные проекты.">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="page-body">
<?php include 'includes/header.php'; ?>

<section class="page-hero">
  <div class="container">
    <h1>О компании</h1>
    <p>Надёжный партнёр в области строительства дорог, аэропортов и инженерных систем</p>
  </div>
</section>

<section class="company-intro">
  <div class="container">
    <div class="company-intro-grid">
      <div class="company-intro-text fade-up">
        <span class="section-eyebrow">Кто мы</span>
        <h2>Более 10 лет строим будущее вместе</h2>
        <p>ООО «Магистраль Р-217» — специализированная компания в области проектирования и поставок материалов для гражданского строительства. На протяжении более чем десяти лет мы являемся надёжным партнёром для застройщиков, дорожных служб и аэропортовых операторов по всей России.</p>
        <p>Наш ключевой принцип — комплексный подход. Мы не просто поставляем материалы: мы предлагаем законченные инженерные решения, включающие проектирование, подбор продукции и сопровождение на всех этапах строительства.</p>
        <p>В портфеле компании — системы сбора и очистки воды, дренажные решения, материалы для дорожного полотна, геосинтетика, изделия для городского благоустройства и многое другое.</p>
      </div>
      <div class="company-intro-visual fade-up fade-up-delay-2" style="background:#f5f5f7;border-radius:20px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;overflow:hidden;">
        <svg viewBox="0 0 420 315" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:75%;opacity:0.12"><rect x="40" y="200" width="340" height="60" rx="6" fill="#004a99"/><rect x="80" y="130" width="70" height="70" rx="6" fill="#004a99"/><rect x="175" y="80" width="70" height="120" rx="6" fill="#004a99"/><rect x="270" y="150" width="70" height="50" rx="6" fill="#004a99"/><path d="M40 200 L420 200" stroke="#004a99" stroke-width="3"/></svg>
      </div>
    </div>
  </div>
</section>

<section style="background:var(--bg-alt);padding:80px 0;">
  <div class="container">
    <div class="section-header fade-up"><span class="section-eyebrow">Наши принципы</span><h2>На чём строится наша работа</h2></div>
    <div class="directions-grid">
      <div class="direction-card fade-up fade-up-delay-1" style="background:#fff;"><svg class="direction-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22l8 8 16-16"/><circle cx="24" cy="24" r="20"/></svg><h4>Качество продукции</h4><p>Поставляем только сертифицированные материалы от проверенных производителей, прошедших строгий входной контроль.</p></div>
      <div class="direction-card fade-up fade-up-delay-2" style="background:#fff;"><svg class="direction-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M24 4l4 8 9 1.3-6.5 6.3 1.5 9L24 24l-8 4.6 1.5-9L11 13.3l9-1.3z"/><path d="M8 36l4-4M40 36l-4-4M24 44v-6"/></svg><h4>Экспертная поддержка</h4><p>Наши инженеры помогут подобрать оптимальное решение, выполнят расчёты и подготовят техническую документацию.</p></div>
      <div class="direction-card fade-up fade-up-delay-3" style="background:#fff;"><svg class="direction-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="20"/><path d="M24 14v10l6 4"/></svg><h4>Соблюдение сроков</h4><p>Чёткое планирование поставок и собственный склад позволяют нам выдерживать сроки даже при работе на крупных объектах.</p></div>
      <div class="direction-card fade-up fade-up-delay-4" style="background:#fff;"><svg class="direction-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 24h8M36 24h8"/><path d="M12 12l5.6 5.6M30.4 30.4L36 36M12 36l5.6-5.6M30.4 17.6L36 12"/><circle cx="24" cy="24" r="8"/></svg><h4>Комплексный подход</h4><p>От проектирования до поставки — один ответственный подрядчик, единая точка контроля качества на всём проекте.</p></div>
    </div>
  </div>
</section>

<section class="projects-section">
  <div class="container">
    <div class="section-header fade-up"><span class="section-eyebrow">Реализованные проекты</span><h2>Опыт, подтверждённый результатами</h2><p>Объекты, в которых мы участвовали — дороги, аэропорты, городское благоустройство по всей России.</p></div>
    <?php
    $projectsFile = __DIR__ . '/data/projects.json';
    $allProjects = file_exists($projectsFile) ? json_decode(file_get_contents($projectsFile), true) : [];
    if (!is_array($allProjects)) $allProjects = [];
    $done    = array_values(array_filter($allProjects, fn($p) => empty($p['current'])));
    $current = array_values(array_filter($allProjects, fn($p) => !empty($p['current'])));
    ?>
    <?php if (!empty($done)): ?>
    <div class="projects-grid-list">
      <?php foreach ($done as $i => $proj): ?>
      <div class="project-card-item fade-up <?= $i > 0 ? 'fade-up-delay-' . min($i, 4) : '' ?>">
        <?php if (!empty($proj['image'])): ?>
          <img src="<?= htmlspecialchars($proj['image']) ?>" alt="<?= htmlspecialchars($proj['title']) ?>" class="project-card-img">
        <?php endif; ?>
        <div class="project-card-label"><?= htmlspecialchars($proj['label'] ?? '') ?></div>
        <h3><?= htmlspecialchars($proj['title']) ?></h3>
        <?php if (!empty($proj['description'])): ?><p><?= htmlspecialchars($proj['description']) ?></p><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($current)): ?>
    <div class="projects-current fade-up">
      <div class="projects-current-label">Текущие объекты</div>
      <p>На сегодняшний день компания ведёт поставки на следующие объекты:</p>
      <ul class="projects-current-list">
        <?php foreach ($current as $proj): ?>
        <li><?= htmlspecialchars($proj['title']) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="cta-section compact" style="background:var(--bg);">
  <div class="container fade-up">
    <h2>Обсудим ваш проект?</h2>
    <p>Расскажите нам о задаче — мы подготовим коммерческое предложение в течение одного рабочего дня.</p>
    <a href="contacts.php" class="btn btn-primary">Связаться с нами</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="js/main.js"></script>
</body>
</html>
