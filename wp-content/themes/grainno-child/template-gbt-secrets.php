<?php
/**
 * Template Name: GBT Secrets Sales Page
 *
 * Copy source: "Grainno_Sales_Page_Copy.docx" (VSL-style one-time-payment
 * offer for Port Harcourt women). Colours/fonts pulled from that doc's own
 * formatting (Georgia display, warm gold accent, deep-green trust, red
 * objection marks, off-white bands) — a deliberately different, editorial
 * register from the gbt-sales dark/neon page.
 * Every text element is inline-editable by logged-in editors - see inc/gbt-editor.php.
 */
defined('ABSPATH') || exit;

// Paystack-hosted Payment Page — proven working (real test payment
// confirmed correct ₦9,800 one-time pricing), unlike the in-app /checkout
// flow, which has zero completed payments in its history.
$checkout_url = 'https://paystack.shop/pay/ntzxc0gpga';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="gbt-secrets-html">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class('gbt-secrets-html'); ?>>
<?php wp_body_open(); ?>

<div class="gbt-secrets">

  <!-- TOP OFFER BAR -->
  <div class="topbar" id="gbtSecretsTopbar">
    <span <?php gbt_attr('topbar.text'); ?>><?php gbt_text('topbar.text', 'The One-Time Offer Ends In'); ?></span>
    <span class="clock" id="gbtSecretsTopClock" aria-live="polite">02:00:00</span>
  </div>

  <!-- HERO -->
  <section class="hero">
    <div class="wrap">
      <span class="eyebrow" <?php gbt_attr('hero.eyebrow'); ?>><?php gbt_text('hero.eyebrow', 'An Anatomist &amp; Body Transformation Coach Reveals'); ?></span>
      <h1 <?php gbt_attr('hero.title'); ?>><?php gbt_text('hero.title', 'How He Helps 9-5 Ladies in Port Harcourt Grow Their Glutes, Build Lower Body, &amp; Get Snatched'); ?></h1>
      <p class="subhead" <?php gbt_attr('hero.subhead'); ?>><?php gbt_text('hero.subhead', 'Without going to the gym, or starving, or wearing waist trainers.'); ?></p>
      <p class="watchnote" <?php gbt_attr('hero.watchnote'); ?>><?php gbt_text('hero.watchnote', 'Watch this video for the full gist'); ?></p>
      <div class="hero-media" <?php gbt_attr('hero.media', true); ?>>
        <div class="play">▶</div>
        <span><?php gbt_text('hero.media.caption', 'VSL video goes here — send the video link or file and it drops straight in.'); ?></span>
      </div>
      <div class="hero-cta-block">
        <a class="btn btn-cta" id="gbtSecretsHeroCta" href="<?php echo esc_url($checkout_url); ?>" <?php gbt_attr('hero.cta'); ?>><?php gbt_text('hero.cta', 'Join Now'); ?></a>
        <p class="btn-note" <?php gbt_attr('hero.trust'); ?>><?php gbt_text('hero.trust', 'Secure payment · Instant access · No monthly fees'); ?></p>
      </div>
    </div>
  </section>

  <!-- INTRO -->
  <section class="band reveal">
    <div class="wrap">
      <p class="intro-copy" <?php gbt_attr('intro.p1'); ?>><?php gbt_text('intro.p1', 'You\'ve tried the gym. You\'ve tried starving. You\'ve tried the flat tummy teas and the waist trainers. You\'ve even Googled "how to lose weight with Nigerian food" or "How to gain healthy weight" and got meal plans full of quinoa and avocado toast. None of it was built for you. This program is designed to change that.'); ?></p>
    </div>
  </section>

  <!-- PAIN POINTS -->
  <section class="band band-cream band-top reveal">
    <div class="wrap">
      <div class="section-head center">
        <h2 <?php gbt_attr('pain.title'); ?>><?php gbt_text('pain.title', 'Does This Sound Familiar?'); ?></h2>
      </div>
      <div class="pain-list">
        <div class="pain-item"><span class="mark">✕</span><p <?php gbt_attr('pain.item1'); ?>><?php gbt_text('pain.item1', 'You followed a workout plan from YouTube for 6 weeks — did every squat, every plank — and your body looks exactly the same because the plan wasn\'t designed for your body type.'); ?></p></div>
        <div class="pain-item"><span class="mark">✕</span><p <?php gbt_attr('pain.item2'); ?>><?php gbt_text('pain.item2', 'You downloaded a calorie counting app, tried to log your eba and egusi soup, and realized none of your Nigerian foods are even in the database. So you gave up.'); ?></p></div>
        <div class="pain-item"><span class="mark">✕</span><p <?php gbt_attr('pain.item3'); ?>><?php gbt_text('pain.item3', 'You paid ₦30k+ for a gym subscription, went for 3 weeks, then stopped — because between Lagos traffic, work stress, and the intimidation of not knowing what to do with those machines, it just wasn\'t sustainable.'); ?></p></div>
        <div class="pain-item"><span class="mark">✕</span><p <?php gbt_attr('pain.item4'); ?>><?php gbt_text('pain.item4', 'You starved yourself for days, lost 4kg of water weight, felt dizzy and weak — and gained it all back the following week the moment you ate a normal meal again.'); ?></p></div>
        <div class="pain-item"><span class="mark">✕</span><p <?php gbt_attr('pain.item5'); ?>><?php gbt_text('pain.item5', 'You bought a waist trainer because one Instagram influencer told you it works. It squeezed your organs for 8 hours a day and gave you nothing but discomfort and false hope.'); ?></p></div>
        <div class="pain-item"><span class="mark">✕</span><p <?php gbt_attr('pain.item6'); ?>><?php gbt_text('pain.item6', 'You asked a slim friend what she eats. She said "I just eat small." That\'s not a strategy. That\'s genetics. And you walked away feeling worse about yourself.'); ?></p></div>
      </div>
      <p class="pain-closing" <?php gbt_attr('pain.closing'); ?>><?php gbt_text('pain.closing', 'None of this happened because you lack discipline. It happened because every program you\'ve tried was built for a different body, a different culture, and a different life. <strong>You\'ve been following someone else\'s blueprint. It\'s time to get yours.</strong>'); ?></p>
    </div>
  </section>

  <!-- INTRODUCING -->
  <section class="band reveal">
    <div class="wrap">
      <div class="section-head center">
        <span class="eyebrow" <?php gbt_attr('intro2.eyebrow'); ?>><?php gbt_text('intro2.eyebrow', 'Introducing'); ?></span>
        <h2 <?php gbt_attr('intro2.title'); ?>><?php gbt_text('intro2.title', 'The Grainno Body Transformation App'); ?></h2>
        <p class="lede" <?php gbt_attr('intro2.lede'); ?>><?php gbt_text('intro2.lede', 'The first fitness app built exclusively for Nigerian women — designed around your body type, your current size, and the Nigerian food you already cook. No gym required.'); ?></p>
      </div>
      <p class="intro-copy" <?php gbt_attr('intro2.p1'); ?>><?php gbt_text('intro2.p1', 'When you sign up, the app asks you targeted questions about your body type (pear, triangle, hourglass, rectangle, inverted triangle), your current size, and your goals. It then generates a personalized workout split and meal plan that matches YOUR body — not a copy-paste template from someone else\'s program.'); ?></p>
      <div class="feat-list">
        <div class="feat-item"><span class="mark">✓</span><p <?php gbt_attr('feat.item1'); ?>><?php gbt_text('feat.item1', '<strong>Body-type matched workouts with video demos.</strong> Every exercise has a video showing proper form — the same techniques learned from working with an international fitness coach. Your split targets the RIGHT muscles for YOUR shape goals.'); ?></p></div>
        <div class="feat-item"><span class="mark">✓</span><p <?php gbt_attr('feat.item2'); ?>><?php gbt_text('feat.item2', '<strong>Nigerian meal plans with real portions.</strong> Meals you already know how to cook — structured with the right macros for your body type. No quinoa. No protein powder. Just eba, moi-moi, grilled fish, beans, and plantain portioned correctly.'); ?></p></div>
        <div class="feat-item"><span class="mark">✓</span><p <?php gbt_attr('feat.item3'); ?>><?php gbt_text('feat.item3', '<strong>Built-in calorie checker for Nigerian foods.</strong> Finally know the real calorie count of your jollof rice, your egusi soup, your fried vs. boiled plantain — and track it without leaving the app.'); ?></p></div>
        <div class="feat-item"><span class="mark">✓</span><p <?php gbt_attr('feat.item4'); ?>><?php gbt_text('feat.item4', '<strong>Home weights guide using household items.</strong> A dedicated video showing you how to turn jerrycans, bottled water, wrappers, and other items into effective workout weights. Zero equipment cost.'); ?></p></div>
        <div class="feat-item"><span class="mark">✓</span><p <?php gbt_attr('feat.item5'); ?>><?php gbt_text('feat.item5', '<strong>Private community of women on the same journey.</strong> Get access to a group chat where you meet accountability partners, share progress, ask questions, and stay motivated.'); ?></p></div>
      </div>
    </div>
  </section>

  <!-- VALUE STACK -->
  <section class="band band-cream band-top reveal" id="pricing">
    <div class="wrap">
      <div class="section-head center">
        <span class="eyebrow" <?php gbt_attr('stack.eyebrow'); ?>><?php gbt_text('stack.eyebrow', "What You're Getting"); ?></span>
        <h2 <?php gbt_attr('stack.title'); ?>><?php gbt_text('stack.title', "You'll Get Everything Here For A One-Time Low Cost"); ?></h2>
      </div>
      <div class="stack-card">
        <div class="stack-head" <?php gbt_attr('stack.cardtitle'); ?>><?php gbt_text('stack.cardtitle', 'Your Complete Body Transformation Package'); ?></div>
        <ul class="stack-lines" <?php gbt_attr('stack.lines'); ?>><?php gbt_text('stack.lines',
          '<li><span class="item">Body-Type Matched Workout Program (with video demos)</span><span class="val">₦25,000</span></li>' .
          '<li><span class="item">Nigerian Food Meal Plan — Personalized to Your Body Type &amp; Goals</span><span class="val">₦15,000</span></li>' .
          '<li><span class="item">Built-in Nigerian Food Calorie Checker</span><span class="val">₦10,000</span></li>' .
          '<li><span class="item">Home Weights Masterclass (Jerrycans, Water Bottles, etc.)</span><span class="val">₦5,000</span></li>' .
          '<li><span class="item">Private Community Access — Lifetime</span><span class="val">₦10,000</span></li>'
        ); ?></ul>
        <div class="stack-total" <?php gbt_attr('stack.totalnote'); ?>><?php gbt_text('stack.totalnote', 'Your price today'); ?><span><s>₦65,000</s></span></div>
        <div class="stack-price">
          <div class="label" <?php gbt_attr('stack.pricelabel'); ?>><?php gbt_text('stack.pricelabel', 'Pay Only'); ?></div>
          <div class="amount" <?php gbt_attr('stack.amount'); ?>><?php gbt_text('stack.amount', '₦9,800'); ?></div>
          <p class="note" <?php gbt_attr('stack.note'); ?>><?php gbt_text('stack.note', 'One-time payment. No monthly subscription. No hidden fees. Lifetime access.'); ?></p>
          <a class="btn btn-cta" href="<?php echo esc_url($checkout_url); ?>" <?php gbt_attr('stack.cta'); ?>><?php gbt_text('stack.cta', 'Get Lifetime Access — ₦9,800'); ?></a>
          <p class="stack-timer">
            <span <?php gbt_attr('stack.timerlabel'); ?>><?php gbt_text('stack.timerlabel', 'Promo price locked in for'); ?></span>
            <span class="clock" id="gbtSecretsStackClock" aria-live="polite">02:00:00</span>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="band reveal">
    <div class="wrap">
      <div class="section-head center">
        <span class="eyebrow" <?php gbt_attr('proof.eyebrow'); ?>><?php gbt_text('proof.eyebrow', 'Results'); ?></span>
        <h2 <?php gbt_attr('proof.title'); ?>><?php gbt_text('proof.title', 'Listen To Some Ladies Already Building Their Dream Body'); ?></h2>
      </div>
      <div class="testi-grid">
        <div class="testi-card">
          <div class="stars">★★★★★</div>
          <q <?php gbt_attr('proof.q1'); ?>><?php gbt_text('proof.q1', 'Omoh... 3-weeks in and my pant is already tighting me. Lovin\' the feeling <span class="emoji">😊</span>'); ?></q>
          <div class="testi-foot">
            <div class="testi-avatar">C</div>
            <div>
              <div class="testi-name" <?php gbt_attr('proof.n1'); ?>><?php gbt_text('proof.n1', 'Chidinma A. · 29, Port Harcourt'); ?></div>
              <div class="testi-tag" <?php gbt_attr('proof.t1'); ?>><?php gbt_text('proof.t1', 'Visible glute growth in 3 weeks'); ?></div>
            </div>
          </div>
        </div>
        <div class="testi-card">
          <div class="stars">★★★★★</div>
          <q <?php gbt_attr('proof.q2'); ?>><?php gbt_text('proof.q2', 'I love how everything is just structured in a way that makes working out easy and sweet to do. Na who no get update dey go gym<span class="emoji">😂</span>'); ?></q>
          <div class="testi-foot">
            <div class="testi-avatar">B</div>
            <div>
              <div class="testi-name" <?php gbt_attr('proof.n2'); ?>><?php gbt_text('proof.n2', 'Blessing O. · 34, Abuja'); ?></div>
              <div class="testi-tag" <?php gbt_attr('proof.t2'); ?>><?php gbt_text('proof.t2', 'Consistency becomes easier'); ?></div>
            </div>
          </div>
        </div>
        <div class="testi-card">
          <div class="stars">★★★★★</div>
          <q <?php gbt_attr('proof.q3'); ?>><?php gbt_text('proof.q3', "Yes, I'm one of those Port Harcourt girls they are referring to. We started this thing even before he built everything into an app. This guy is good sha... If not for facebook that doesn't allow before and after picture, I for show una my evidence"); ?></q>
          <div class="testi-foot">
            <div class="testi-avatar">C</div>
            <div>
              <div class="testi-name" <?php gbt_attr('proof.n3'); ?>><?php gbt_text('proof.n3', 'Cherry · 26, Port Harcourt'); ?></div>
              <div class="testi-tag" <?php gbt_attr('proof.t3'); ?>><?php gbt_text('proof.t3', 'Toned upper body, well-built lower body'); ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MOTIVATION -->
  <section class="band band-cream band-top motivate reveal">
    <div class="wrap">
      <h2 <?php gbt_attr('motivate.title'); ?>><?php gbt_text('motivate.title', 'The best time to start your body transformation journey was yesterday. The second best time is NOW.'); ?></h2>
      <p <?php gbt_attr('motivate.p1'); ?>><?php gbt_text('motivate.p1', "Ladies who try to begin their body transformation after giving birth would tell you how difficult it gets at that time. Start now, so that in the nearest future you'll only have to maintain what you've built so far."); ?></p>
      <a class="btn btn-cta" href="<?php echo esc_url($checkout_url); ?>" <?php gbt_attr('motivate.cta'); ?>><?php gbt_text('motivate.cta', 'Get Lifetime Access — ₦9,800'); ?></a>
    </div>
  </section>

  <!-- GUARANTEE -->
  <section class="band reveal">
    <div class="wrap">
      <div class="guarantee">
        <div class="shield">🛡</div>
        <h3 <?php gbt_attr('guarantee.title'); ?>><?php gbt_text('guarantee.title', '30-Day Try-It-Or-Your-Money-Back Guarantee'); ?></h3>
        <p <?php gbt_attr('guarantee.text'); ?>><?php gbt_text('guarantee.text', "Download the app. Do the workouts. Follow your meal plan. If after 30 days you don't feel like this was built for you and your body – send me a message and get a full refund. No questions asked."); ?></p>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="band band-cream band-top reveal" id="faq">
    <div class="wrap">
      <div class="section-head center">
        <span class="eyebrow" <?php gbt_attr('faq.eyebrow'); ?>><?php gbt_text('faq.eyebrow', 'Common Questions'); ?></span>
        <h2 <?php gbt_attr('faq.title'); ?>><?php gbt_text('faq.title', 'Before You Decide'); ?></h2>
      </div>
      <div class="faq-list">
        <div class="faq-item" data-open="true">
          <button class="faq-q"><span <?php gbt_attr('faq.q1'); ?>><?php gbt_text('faq.q1', 'Do I need gym equipment?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a1'); ?>><?php gbt_text('faq.a1', "No. Every workout is designed for home. There's a video inside showing you how to make your own weights using jerrycans, water bottles, and other items you already have."); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q2'); ?>><?php gbt_text('faq.q2', 'Will the meal plan work with Nigerian food?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a2'); ?>><?php gbt_text('faq.a2', "That's the whole point. The meal plans are 100% Nigerian food — rice, beans, moi-moi, plantain, soups, proteins, fruits, vegetables — all structured with the right portions for your body type and goals. No foreign meals."); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q3'); ?>><?php gbt_text('faq.q3', "I'm slim and want to gain weight in the right places. Is this for me?"); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a3'); ?>><?php gbt_text('faq.a3', "Yes. The app asks about your current size and goals during signup. If you're slim and want to build your lower body and add healthy weight, your workout split and meal plan will be completely different from someone who wants to lose fat. That's the whole point of body-type personalization."); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q4'); ?>><?php gbt_text('faq.q4', 'What if I just had a baby?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a4'); ?>><?php gbt_text('faq.a4', 'Many women in the program are postpartum. Start slow, follow the beginner split, and progress at your own pace. The community chat also has other mothers sharing their recovery journey.'); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q5'); ?>><?php gbt_text('faq.q5', 'Is this a one-time payment or subscription?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a5'); ?>><?php gbt_text('faq.a5', "Right now, it's a one-time payment of ₦9,800 for lifetime access — workouts, meal plans, calorie checker, community, everything. This will move to a ₦5,000/month subscription model soon. Early joiners keep lifetime access forever."); ?></div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span <?php gbt_attr('faq.q6'); ?>><?php gbt_text('faq.q6', 'How do I access the app after paying?'); ?></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner" <?php gbt_attr('faq.a6'); ?>><?php gbt_text('faq.a6', "You'll get instant access via email and WhatsApp after your payment confirms. Works on any Android or iPhone."); ?></div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- FINAL CTA -->
  <section class="band final-band reveal">
    <div class="wrap">
      <h2 <?php gbt_attr('final.title'); ?>><?php gbt_text('final.title', "Your body is not the problem. Your food is not the problem. You've just never had a plan that was actually built for you."); ?></h2>
      <a class="btn btn-cta" href="<?php echo esc_url($checkout_url); ?>" <?php gbt_attr('final.cta'); ?>><?php gbt_text('final.cta', 'Start Your Body Transformation — ₦9,800'); ?></a>
      <p class="btn-note" <?php gbt_attr('final.note'); ?>><?php gbt_text('final.note', 'One-time payment · Lifetime access · 30-day money-back guarantee'); ?></p>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="wrap">
      <p class="brand"><?php gbt_text('footer.brand', 'Grainno Body Transformation App · Freedom Gladiators Agency'); ?></p>
      <p <?php gbt_attr('footer.contact'); ?>><?php gbt_text('footer.contact', 'Questions? Contact: hello@freedomgladiators.net'); ?></p>
      <p <?php gbt_attr('footer.legal'); ?>><?php gbt_text('footer.legal', '© ' . date('Y') . ' Freedom Gladiators Agency. All rights reserved. Results vary. This program provides workout and meal guidance — individual outcomes depend on consistency, effort, and individual body factors. This is not medical advice. Consult your doctor before starting any fitness program.'); ?></p>
    </div>
  </footer>

  <!-- STICKY CTA BAR -->
  <div class="sticky-cta" id="gbtSecretsStickyCta">
    <span class="info" <?php gbt_attr('sticky.text'); ?>><?php gbt_text('sticky.text', 'Grainno Body Transformation · <strong>₦9,800 lifetime</strong>'); ?></span>
    <a class="btn btn-cta" href="<?php echo esc_url($checkout_url); ?>" <?php gbt_attr('sticky.cta'); ?>><?php gbt_text('sticky.cta', 'Get Access →'); ?></a>
  </div>

</div>

<?php wp_footer(); ?>
</body>
</html>
