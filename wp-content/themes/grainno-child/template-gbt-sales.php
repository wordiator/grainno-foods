<?php
/**
 * Template Name: GBT Sales Page
 *
 * Copy source: "Grainno Sales Page - Copy Edit Sheet" (sales-page-v2, 10 July 2026).
 * Every text element is inline-editable by logged-in editors - see inc/gbt-editor.php.
 * The strings below are the defaults; saved edits live in the page's _gbt_content meta.
 */
defined('ABSPATH') || exit;

$quiz_url = 'https://gbt.grainnofoods.com/quiz';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="gbt-sales">

  <!-- SECTION 1 - HERO -->
  <section class="hero">
    <video class="hero-bg-video" autoplay muted loop playsinline preload="metadata" aria-hidden="true">
      <source src="<?php echo esc_url(get_stylesheet_directory_uri() . '/gbt-sales/hero-bg.mp4'); ?>" type="video/mp4">
    </video>
    <div class="hero-bg-overlay" aria-hidden="true"></div>
    <div class="wrap hero-grid">
      <div>
        <span class="eyebrow" <?php gbt_attr('hero.eyebrow'); ?>><?php gbt_text('hero.eyebrow', 'Science-based fitness app designed to help African women'); ?></span>
        <h1 <?php gbt_attr('hero.title'); ?>><?php gbt_text('hero.title', '<span class="hero-line1">Sweat in the Palour.</span> <span class="ankara-text hero-line2">Shutdown the Party.</span>'); ?></h1>
        <p class="deck" <?php gbt_attr('hero.deck'); ?>><?php gbt_text('hero.deck', 'A body recomposition app for African women who want to grow their feminine features. Home workouts - no gym needed.'); ?></p>
        <div class="hero-cta-block">
          <a class="btn btn-cta" id="gbtHeroCta" href="<?php echo esc_url($quiz_url); ?>" <?php gbt_attr('hero.cta'); ?>><?php gbt_text('hero.cta', 'Begin Your Body Transformation Journey'); ?></a>
          <p class="cta-note" <?php gbt_attr('hero.note'); ?>><?php gbt_text('hero.note', 'Get a personalised body transformation routine based on your current body type and size.'); ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 2 - THE DRESS STORY -->
  <section class="band reveal">
    <div class="wrap">
      <div class="section-head">
        <h2 <?php gbt_attr('dress.title'); ?>><?php gbt_text('dress.title', "Remember that dress? The one you tried on, then couldn't even look at yourself in the mirror?"); ?></h2>
      </div>
      <div class="story-copy">
        <p <?php gbt_attr('dress.p1'); ?>><?php gbt_text('dress.p1', "So you gave it to your sister. Or dumped at the back of the wardrobe. Or returned it to the vendor. And you consoled yourself, saying that's just the nature of your body; nothing can change it."); ?></p>
        <p <?php gbt_attr('dress.p2'); ?>><?php gbt_text('dress.p2', 'After speaking with hundreds of African women, we heard similar challenges like these:'); ?></p>
      </div>
      <div class="quote-grid">
        <div class="quote-card reveal reveal-d1">
          <q <?php gbt_attr('dress.q1'); ?>><?php gbt_text('dress.q1', "\"I bought a dress, put it on… I couldn't even look up in the mirror. A lot of outfits I've abandoned. A lot of dresses I admire on people but can't wear.\""); ?></q>
          <div class="quote-tag" <?php gbt_attr('dress.q1tag'); ?>><?php gbt_text('dress.q1tag', 'Mirror-on-the-wall moment'); ?></div>
        </div>
        <div class="quote-card reveal reveal-d2">
          <q <?php gbt_attr('dress.q2'); ?>><?php gbt_text('dress.q2', "\"When I lose weight, I lose my butt and hips. I don't know how to lose the weight and still keep my shape.\""); ?></q>
          <div class="quote-tag" <?php gbt_attr('dress.q2tag'); ?>><?php gbt_text('dress.q2tag', 'She was losing it all'); ?></div>
        </div>
        <div class="quote-card reveal reveal-d3">
          <q <?php gbt_attr('dress.q3'); ?>><?php gbt_text('dress.q3', "\"I want to wear a bodycon and stop wearing shapewear. I just haven't found a plan I can actually trust.\""); ?></q>
          <div class="quote-tag" <?php gbt_attr('dress.q3tag'); ?>><?php gbt_text('dress.q3tag', 'Honestly, her trust issues are valid'); ?></div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 3 - THE "NATURE" LIE -->
  <section class="band band-raised reveal">
    <div class="wrap">
      <div class="section-head">
        <h2 <?php gbt_attr('nature.title'); ?>><?php gbt_text('nature.title', "You Didn't Fail. The 7-Day Promises Did."); ?></h2>
      </div>
      <div class="story-copy">
        <p <?php gbt_attr('nature.p1'); ?>><?php gbt_text('nature.p1', "Your bumbum and curves are shaped by muscles. And muscles can't be grown in 7 days by anything you swallow; only by being trained and fed correctly."); ?></p>
        <p <?php gbt_attr('nature.p2'); ?>><?php gbt_text('nature.p2', "If Quick Fixes Worked, You'd Already Have the Body. You Need a Real Plan."); ?></p>
      </div>
      <div class="compare-grid">
        <div class="compare-card bad reveal reveal-d1">
          <h3 <?php gbt_attr('nature.badtitle'); ?>><?php gbt_text('nature.badtitle', '✗ What you were sold'); ?></h3>
          <ul class="compare-list" <?php gbt_attr('nature.badlist'); ?>><?php gbt_text('nature.badlist',
            '<li>Pills &amp; syrups that gave you heartburn, or dried you up and flattened the very bum you wanted</li>' .
            '<li>"7-day results" that scared you (rightly) about damaging your body</li>' .
            '<li>Months of gym with no structure, hence no progression, no result</li>' .
            '<li>Diets built for foreign bodies and foreign kitchens</li>'); ?></ul>
        </div>
        <div class="compare-card good reveal reveal-d2">
          <h3 <?php gbt_attr('nature.goodtitle'); ?>><?php gbt_text('nature.goodtitle', '✓ What actually grows curves'); ?></h3>
          <ul class="compare-list" <?php gbt_attr('nature.goodlist'); ?>><?php gbt_text('nature.goodlist',
            '<li>A training structure that progresses week by week</li>' .
            '<li>Eating enough of the right food, in exact amounts without guessing</li>' .
            '<li>Your own African/Nigerian meals, portioned in grams for YOUR goal</li>' .
            '<li>Consistency made easy: reminders, streaks, and women on the same journey</li>'); ?></ul>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 4 - 3 STEPS -->
  <section class="band band-light reveal">
    <div class="wrap">
      <div class="section-head">
        <h2 <?php gbt_attr('steps.title'); ?>><?php gbt_text('steps.title', 'Your structured plan. In seconds.'); ?></h2>
        <p class="lede" <?php gbt_attr('steps.lede'); ?>><?php gbt_text('steps.lede', "No more \"I don't know where to start.\" The app builds you a routine instantly."); ?></p>
      </div>
      <div class="steps">
        <div class="step reveal reveal-d1"><div class="step-num">01</div><h3 <?php gbt_attr('steps.s1t'); ?>><?php gbt_text('steps.s1t', 'Take the quiz'); ?></h3><p <?php gbt_attr('steps.s1p'); ?>><?php gbt_text('steps.s1p', 'Takes less than 5 minutes. We identify your body type, size, and goal: grow curves, gain healthy weight, lose belly, or recomp. Then we calculate your exact daily calories &amp; protein while building your personalised workout routine.'); ?></p></div>
        <div class="step reveal reveal-d2"><div class="step-num">02</div><h3 <?php gbt_attr('steps.s2t'); ?>><?php gbt_text('steps.s2t', 'Pick your meals'); ?></h3><p <?php gbt_attr('steps.s2p'); ?>><?php gbt_text('steps.s2p', 'Choose from 250+ carefully curated Nigerian dishes you already eat: beans, egusi, moi moi, suya. Perfect for picky eaters because the plan is built ONLY from food you picked.'); ?></p></div>
        <div class="step reveal reveal-d3"><div class="step-num">03</div><h3 <?php gbt_attr('steps.s3t'); ?>><?php gbt_text('steps.s3t', 'Train. Track. Transform.'); ?></h3><p <?php gbt_attr('steps.s3p'); ?>><?php gbt_text('steps.s3p', 'Home or gym workouts matched to your goal, gram-perfect portions, streaks and reminders that keep you locked in.'); ?></p></div>
      </div>
    </div>
  </section>

  <!-- SECTION 5 - FEATURE A: WORKOUTS -->
  <section class="band band-raised reveal">
    <div class="wrap feature-row">
      <div class="feature-copy">
        <span class="eyebrow" <?php gbt_attr('feata.eyebrow'); ?>><?php gbt_text('feata.eyebrow', 'Body Toning, Glutes, &amp; Curves Workouts'); ?></span>
        <h2 <?php gbt_attr('feata.title'); ?>><?php gbt_text('feata.title', 'Gym subscription is no longer a barrier'); ?></h2>
        <p class="lede" <?php gbt_attr('feata.lede'); ?>><?php gbt_text('feata.lede', 'Structured body recomposition workouts you can do in your room with things already in your house, plus an option to switch to gym mode when you have access. Every session is logged, set by set.'); ?></p>
        <ul class="check-list" <?php gbt_attr('feata.list'); ?>><?php gbt_text('feata.list',
          "<li>The app tells you when to increase weight to ensure you're making progress</li>" .
          '<li>You choose your training days to fit school or work</li>' .
          "<li>A guide for complete beginners so you don't get lost on the go</li>" .
          "<li>Video attached to every home workout to ensure you're doing it right</li>" .
          "<li>How to make your own weights with household items so you don't spend money on expensive dumbbells</li>"); ?></ul>
      </div>
      <div class="feature-media media-ph" <?php gbt_attr('feata.media', true); ?>><?php gbt_text('feata.media.caption', '[APP SCREENSHOT]<br>Glute workout screen: household-item exercise with set logging'); ?></div>
    </div>
  </section>

  <!-- SECTION 6 - FEATURE B: MEAL PLANNER -->
  <section class="band band-light reveal">
    <div class="wrap feature-row flip">
      <div class="feature-copy">
        <span class="eyebrow" <?php gbt_attr('featb.eyebrow'); ?>><?php gbt_text('featb.eyebrow', 'Meal planner'); ?></span>
        <h2 <?php gbt_attr('featb.title'); ?>><?php gbt_text('featb.title', 'Know exactly what to eat'); ?></h2>
        <p class="lede" <?php gbt_attr('featb.lede'); ?>><?php gbt_text('featb.lede', "Whether you're trying to gain healthy weight, glutes &amp; curves, or even lose weight, you'll get the customised meal plan tailored to your goals."); ?></p>
        <ul class="check-list" <?php gbt_attr('featb.list'); ?>><?php gbt_text('featb.list',
          '<li>250+ carefully curated healthy meals, not AI-generated</li>' .
          '<li>Batch-cook Sunday plans for busy students &amp; workers</li>' .
          '<li>Auto shopping list for the market</li>' .
          '<li>Tap any meal to see every ingredient and the quantity required to meet your caloric and protein needs.</li>'); ?></ul>
      </div>
      <div class="feature-media media-ph" <?php gbt_attr('featb.media', true); ?>><?php gbt_text('featb.media.caption', '[APP SCREENSHOT]<br>Meal plan: jollof portioned in grams to her target'); ?></div>
    </div>
  </section>

  <!-- SECTION 7 - FEATURE C: CONSISTENCY -->
  <section class="band band-raised reveal">
    <div class="wrap feature-row">
      <div class="feature-copy">
        <span class="eyebrow" <?php gbt_attr('featc.eyebrow'); ?>><?php gbt_text('featc.eyebrow', "We've solved your consistency problem"); ?></span>
        <h2 <?php gbt_attr('featc.title'); ?>><?php gbt_text('featc.title', "You don't lack discipline. You lacked a system."); ?></h2>
        <p class="lede" <?php gbt_attr('featc.lede'); ?>><?php gbt_text('featc.lede', "Reminders so you never \"forget.\" Streaks that make showing up feel like winning. A community of women on the same journey, so you finally know you're not alone in this."); ?></p>
        <ul class="check-list" <?php gbt_attr('featc.list'); ?>><?php gbt_text('featc.list',
          '<li>Regular check-ins: weight, energy, how your clothes fit</li>' .
          '<li>30-day trend line: see real proof, stay motivated</li>' .
          "<li>Direct support chat with the Grainno team when you're stuck</li>"); ?></ul>
      </div>
      <div class="feature-media media-ph" <?php gbt_attr('featc.media', true); ?>><?php gbt_text('featc.media.caption', '[APP SCREENSHOT]<br>Streak + community screen'); ?></div>
    </div>
  </section>

  <!-- SECTION 8 - PROOF DEMO -->
  <section class="band reveal">
    <div class="wrap feature-row flip">
      <div class="feature-copy">
        <span class="eyebrow" <?php gbt_attr('proof.eyebrow'); ?>><?php gbt_text('proof.eyebrow', "Why your effort wasn't showing"); ?></span>
        <h2 <?php gbt_attr('proof.title'); ?>><?php gbt_text('proof.title', 'Same chicken. Almost double the calories.'); ?></h2>
        <p class="lede" <?php gbt_attr('proof.lede'); ?>><?php gbt_text('proof.lede', 'How you cook changes your numbers. Switch any ingredient (boiled, grilled, fried, air-fried) and watch the calories recalculate live. No nutritionist fee required.'); ?></p>
        <div class="proof-cards">
          <div class="proof-card">
            <div class="proof-label" <?php gbt_attr('proof.c1label'); ?>><?php gbt_text('proof.c1label', 'Boiled'); ?></div>
            <div class="proof-num" data-count="165">0</div>
            <div class="proof-cap" <?php gbt_attr('proof.c1cap'); ?>><?php gbt_text('proof.c1cap', 'kcal · 100g chicken breast'); ?></div>
          </div>
          <div class="proof-card hot">
            <div class="proof-label" <?php gbt_attr('proof.c2label'); ?>><?php gbt_text('proof.c2label', 'Deep-fried'); ?></div>
            <div class="proof-num" data-count="290" data-suffix="+">0</div>
            <div class="proof-cap" <?php gbt_attr('proof.c2cap'); ?>><?php gbt_text('proof.c2cap', 'kcal · same 100g chicken'); ?></div>
          </div>
        </div>
      </div>
      <div class="feature-media media-video" <?php gbt_attr('proof.media', true); ?>>
        <video autoplay muted loop playsinline preload="metadata">
          <source src="<?php echo esc_url(get_stylesheet_directory_uri() . '/gbt-sales/prep-method-demo.mp4'); ?>" type="video/mp4">
        </video>
      </div>
    </div>
  </section>

  <!-- SECTION 9 - AUTHORITY -->
  <section class="band band-raised reveal">
    <div class="wrap authority-grid">
      <div class="media-ph tall" <?php gbt_attr('auth.media', true); ?>><?php gbt_text('auth.media.caption', '[PHOTO OF JULIUS]<br>Portrait: coaching or training setting'); ?></div>
      <div class="authority-copy">
        <span class="eyebrow" <?php gbt_attr('auth.eyebrow'); ?>><?php gbt_text('auth.eyebrow', 'Who built this, and why you can trust it'); ?></span>
        <h2 <?php gbt_attr('auth.title'); ?>><?php gbt_text('auth.title', 'A Certified Human Anatomist With Science-Backed Fitness Experience'); ?></h2>
        <p <?php gbt_attr('auth.p1'); ?>><?php gbt_text('auth.p1', "I'm Julius, the person behind Grainno brand. I spent four years studying the human body and trained as a human anatomist, so I know exactly how glutes and other muscles grow, where your body stores fat, and why body recomposition is not as hard as you think."); ?></p>
        <p <?php gbt_attr('auth.p2'); ?>><?php gbt_text('auth.p2', 'As a self-trained digital marketer, I worked alongside an international fitness coach who specialises in transforming women, and gained access to the premium training systems he used to take ladies of every body type to their desired figures.'); ?></p>
        <p <?php gbt_attr('auth.p3'); ?>><?php gbt_text('auth.p3', 'This app is those systems + current exercise science, built for African women and African food. This is not a magic pill or get-snatched-quick scheme. You can see inside every meal and every workout yourself.'); ?></p>
        <div class="badge-row" <?php gbt_attr('auth.badges'); ?>><?php gbt_text('auth.badges',
          '<span class="badge">Trained Human Anatomist</span>' .
          '<span class="badge">Female-focused coaching systems</span>' .
          '<span class="badge">Science-backed methods</span>' .
          '<span class="badge">24/7 access to me (your coach)</span>'); ?></div>
      </div>
    </div>
  </section>

  <!-- SECTION 10 - PRICING -->
  <section class="band reveal" id="pricing">
    <div class="wrap">
      <div class="section-head">
        <h2 <?php gbt_attr('price.title'); ?>><?php gbt_text('price.title', 'Everything above. For about the price of one shawarma'); ?></h2>
        <p class="lede" <?php gbt_attr('price.lede'); ?>><?php gbt_text('price.lede', "You've spent more on things that didn't work. This time, spend less on something you'll never regret."); ?></p>
      </div>
      <div class="anchor-row" <?php gbt_attr('price.anchors'); ?>><?php gbt_text('price.anchors',
        '<span><s>₦20,000+</s> · 1 month of gym</span>' .
        '<span><s>₦30,000+</s> · one nutritionist consult</span>' .
        '<span><s>₦15,000+</s> · pills &amp; syrups that failed</span>'); ?></div>
      <div class="price-card reveal reveal-d1">
        <span class="price-ribbon" <?php gbt_attr('price.ribbon'); ?>><?php gbt_text('price.ribbon', 'FOUNDING-MEMBER PRICE'); ?></span>
        <div class="price-amount" <?php gbt_attr('price.amount'); ?>><?php gbt_text('price.amount', '₦5,000'); ?></div>
        <div class="price-under" <?php gbt_attr('price.under'); ?>><?php gbt_text('price.under', 'per month · cancel anytime'); ?></div>
        <div class="price-compare" <?php gbt_attr('price.compare'); ?>><?php gbt_text('price.compare', "That's about ₦167 a day. Founding members keep this rate for life; when founding access closes, the price becomes ₦10,000/month."); ?></div>
        <ul class="price-list" <?php gbt_attr('price.list'); ?>><?php gbt_text('price.list',
          '<li>Personal body assessment &amp; exact daily numbers</li>' .
          '<li>Glute, curves, &amp; body toning workouts you can do at home</li>' .
          '<li>250+ curated Nigerian meals, portioned in exact grams + shopping lists</li>' .
          '<li>Prep-method calorie switching</li>' .
          '<li>Streaks, reminders &amp; progress tracking</li>' .
          '<li>Community + direct support from the Grainno team</li>'); ?></ul>
        <a class="btn btn-cta" href="<?php echo esc_url($quiz_url); ?>" <?php gbt_attr('price.cta'); ?>><?php gbt_text('price.cta', 'Begin Your Body Transformation Journey'); ?></a>
        <div class="trust-chips" <?php gbt_attr('price.chips'); ?>><?php gbt_text('price.chips',
          '<span class="chip">Regular community calls with Julius</span>' .
          '<span class="chip">24/7 access to Julius</span>' .
          '<span class="chip">Real support from real people</span>'); ?></div>
      </div>
    </div>
  </section>

  <!-- SECTION 11 - FAQ -->
  <section class="band band-raised reveal" id="faq">
    <div class="wrap">
      <div class="section-head">
        <h2 <?php gbt_attr('faq.title'); ?>><?php gbt_text('faq.title', "Every question you're thinking. Answered honestly."); ?></h2>
      </div>
      <div class="faq-list">
        <div class="faq-item" data-open="true">
          <button class="faq-q"><span <?php gbt_attr('faq.q1'); ?>><?php gbt_text('faq.q1', 'My family says a flat bum is just nature. Can it really change?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a1'); ?>><?php gbt_text('faq.a1', "Glutes are muscles, the largest muscle group in your body. Muscles grow when trained progressively and fed enough protein. Genetics sets your starting point, not your ceiling. What's been missing is a structured plan, not different DNA."); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q2'); ?>><?php gbt_text('faq.q2', 'Every time I lose weight, I lose my bum too. How is this different?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a2'); ?>><?php gbt_text('faq.a2', "Because crash diets shrink everything. Body recomposition is different: you train the glutes so your body keeps and builds that muscle while the belly reduces. That's exactly what your goal-matched plan is designed around."); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q3'); ?>><?php gbt_text('faq.q3', 'Is this pills, tea, or anything I swallow?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a3'); ?>><?php gbt_text('faq.a3', "Never. Grainno sells no pills, or syrups. Your transformation comes from training + food you already eat, in the right amounts. Nothing that can give you heartburn or \"dry you up.\""); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q4'); ?>><?php gbt_text('faq.q4', "I'm a picky eater / I find it hard to eat much. Will this work?"); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a4'); ?>><?php gbt_text('faq.a4', 'You pick every meal in your plan yourself; the app never forces food on you. And if gaining is your goal, your portions are set to make eating enough feel achievable, not overwhelming.'); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q5'); ?>><?php gbt_text('faq.q5', "I'm a student: no gym money, no time. Can I do this?"); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a5'); ?>><?php gbt_text('faq.a5', 'Yes. Home workouts use items already in your house, you choose your training days, and batch-cook plans mean one cooking day covers your week. This was built for busy, broke seasons of life.'); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q6'); ?>><?php gbt_text('faq.q6', 'How fast will I see results?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a6'); ?>><?php gbt_text('faq.a6', 'Honestly? Not in 7 days, and anyone promising that is who you should run from. With consistency, most women start noticing changes in how clothes fit within weeks, with visible changes building over months. The app tracks it all so you can see it happening.'); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q7'); ?>><?php gbt_text('faq.q7', "I've been disappointed before. Why should I trust this?"); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a7'); ?>><?php gbt_text('faq.a7', "Don't trust. Verify. If it takes just shawarma money to discover something that has the potential to transform your body and boost your confidence, isn't it worth it?"); ?></div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 12 - FINAL CTA -->
  <section class="band final-band reveal">
    <div class="wrap">
      <h2 <?php gbt_attr('final.title'); ?>><?php gbt_text('final.title', 'That dress you gave away? <span class="ankara-text">You\'re buying it back.</span>'); ?></h2>
      <p class="lede" <?php gbt_attr('final.lede'); ?>><?php gbt_text('final.lede', 'December parties are only months away, and muscle takes months, not days. The women who shut down December start now: a plan built from your body and your food, in your room.'); ?></p>
      <a class="btn btn-cta" href="<?php echo esc_url($quiz_url); ?>" <?php gbt_attr('final.cta'); ?>><?php gbt_text('final.cta', "I'm Ready to Transform my Body"); ?></a>
    </div>
  </section>

  <!-- SECTION 13 - FOOTER -->
  <footer class="footer">
    <div class="wrap">
      <p <?php gbt_attr('footer.text'); ?>><?php gbt_text('footer.text', '© ' . date('Y') . ' Grainno · Results depend on individual consistency and adherence. This app provides fitness and nutrition planning tools, not medical advice. If you have a medical condition (e.g. PCOS, hormonal issues), please consult your doctor alongside any program. This app is strictly for ages 19+.'); ?></p>
    </div>
  </footer>

  <!-- STICKY MOBILE CTA -->
  <div class="sticky-cta" id="gbtStickyCta">
    <a class="btn btn-cta" href="<?php echo esc_url($quiz_url); ?>" <?php gbt_attr('sticky.cta'); ?>><?php gbt_text('sticky.cta', 'Begin Your Body Transformation Journey'); ?></a>
  </div>

</div>

<?php wp_footer(); ?>
</body>
</html>
