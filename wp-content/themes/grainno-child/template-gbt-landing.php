<?php
/**
 * Template Name: GBT Landing
 */
defined('ABSPATH') || exit;

$wa_number      = get_option('grainno_whatsapp_number', GRAINNO_WHATSAPP);
$wa_support_url = 'https://wa.me/' . $wa_number;
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

<div class="gbt-page">

  <header class="nav">
    <div class="wrap nav-row">
      <a class="wordmark" href="<?php echo esc_url(home_url('/')); ?>">GBT<span>.</span></a>
      <nav class="nav-links">
        <a href="#how-it-works">How it works</a>
        <a href="#dictionary">The Dictionary</a>
        <a href="#features">Features</a>
        <a href="#pricing">Pricing</a>
        <a href="#faq">FAQ</a>
      </nav>
      <a class="btn btn-primary nav-cta" href="https://bodyrecomp.grainnofoods.com/quiz">Start the Quiz →</a>
      <button class="nav-burger" id="burger" aria-expanded="false" aria-controls="mobileNav" aria-label="Toggle menu">
        <svg id="burgerIcon" width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.6"><line x1="1" y1="4" x2="17" y2="4"/><line x1="1" y1="9" x2="17" y2="9"/><line x1="1" y1="14" x2="17" y2="14"/></svg>
      </button>
    </div>
    <div class="wrap nav-mobile" id="mobileNav">
      <a href="#how-it-works">How it works</a>
      <a href="#dictionary">The Dictionary</a>
      <a href="#features">Features</a>
      <a href="#pricing">Pricing</a>
      <a href="#faq">FAQ</a>
      <a class="btn btn-primary" style="justify-content:center" href="https://bodyrecomp.grainnofoods.com/quiz">Start the Quiz →</a>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="wrap hero-grid">
      <div>
        <div class="pill hero-badge">🌍 Built for African Bodies</div>
        <h1>Finally, a meal plan that speaks <em>Jollof.</em></h1>
        <p class="lede">Grainno Body Transformation turns your body goal into a personalized calorie target, a meal plan built from the food you already eat, and a workout plan you'll actually follow — no foreign diets, no guesswork, no gym-bro jargon.</p>
        <div class="hero-ctas">
          <a class="btn btn-primary" href="https://bodyrecomp.grainnofoods.com/quiz">Start the Quiz →</a>
          <a class="btn btn-ghost" href="https://bodyrecomp.grainnofoods.com">Explore the Tools</a>
        </div>
        <div class="trust-strip">
          <span>100% Free</span><span>No Downloads</span><span>African Foods</span><span>Takes 5 Minutes</span>
        </div>
      </div>
      <div class="card-stack" aria-hidden="true">
        <div class="flash-card c3">
          <div class="from">Other apps say</div>
          <div class="from-term">Oats, dry — no toppings</div>
          <div class="to">GBT says</div>
          <div class="to-term">Akara &amp; pap</div>
        </div>
        <div class="flash-card c2">
          <div class="from">Other apps say</div>
          <div class="from-term">Chicken breast, plain</div>
          <div class="to">GBT says</div>
          <div class="to-term">Suya</div>
        </div>
        <div class="flash-card c1">
          <div class="from">Other apps say</div>
          <div class="from-term">Quinoa bowl</div>
          <div class="to">GBT says</div>
          <div class="to-term">Jollof rice</div>
        </div>
      </div>
    </div>
  </section>

  <!-- THE PROBLEM -->
  <section class="band reveal">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">What people tell us</span>
        <h2>You've tried Apetamin. Protein powders. Hip pills. Nothing worked.</h2>
        <p class="lede">Every sign-up starts with our onboarding quiz — this is what real users told us about themselves, unfiltered.</p>
      </div>
      <div class="quote-grid">
        <div class="quote-card">
          <q>I'm too skinny — I eat but nothing sticks.</q>
          <div class="quote-tag">— Weight Gainer</div>
        </div>
        <div class="quote-card">
          <q>I want bigger hips and a flatter stomach.</q>
          <div class="quote-tag">— Curve Seeker</div>
        </div>
        <div class="quote-card">
          <q>I want to build muscle and look stronger.</q>
          <div class="quote-tag">— Muscle Builder</div>
        </div>
        <div class="quote-card">
          <q>I just want to eat healthier and have more energy.</q>
          <div class="quote-tag">— Healthy Eater</div>
        </div>
      </div>
      <p class="problem-foot">What they're afraid of: side effects, wasting money, it not working. Some are simply ready to commit — that's who GBT is built for.</p>
    </div>
  </section>

  <!-- INSIGHT -->
  <section class="band insight-band reveal">
    <div class="wrap">
      <span class="eyebrow">The core insight</span>
      <p class="insight-statement" style="margin-top:1.2rem;">Nearly every fitness app is built around chicken breast, broccoli, and quinoa — and Western prices. That's a wall. GBT is built the other way: from the food you already cook and can already afford, <em>outward</em>.</p>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="band band-tight reveal" id="how-it-works">
    <div class="wrap">
      <div class="section-head" style="margin-bottom:2.5rem;">
        <span class="eyebrow">How it works</span>
        <h2>Four steps. No app store.</h2>
      </div>
      <div class="steps">
        <div class="step"><div class="step-num">01</div><h3>Take the quiz</h3><p>5 minutes. Tells us your goal — gain, curves, muscle, or health.</p></div>
        <div class="step"><div class="step-num">02</div><h3>Get your numbers</h3><p>Calories, protein, carbs, fat — exact, for your body and activity level.</p></div>
        <div class="step"><div class="step-num">03</div><h3>Pick your meals</h3><p>Up to 7 per category. Food you'll actually eat, not food you're told to.</p></div>
        <div class="step"><div class="step-num">04</div><h3>Get your plan</h3><p>7 or 14 days, built instantly — no AI wait, no guesswork.</p></div>
      </div>
    </div>
  </section>

  <!-- DICTIONARY -->
  <section class="band reveal" id="dictionary">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">The GBT dictionary</span>
        <h2>The first fitness app that speaks African food.</h2>
        <p class="lede">Same science. Different vocabulary. Here's how the usual diet-app language translates.</p>
      </div>
      <div class="dict-grid">
        <div class="dict-entry"><span class="tag">carb + veg</span><div class="term-from">Quinoa bowl</div><div class="arrow">↓</div><div class="term-to">Jollof rice</div></div>
        <div class="dict-entry"><span class="tag">protein</span><div class="term-from">Chicken breast, plain</div><div class="arrow">↓</div><div class="term-to">Suya</div></div>
        <div class="dict-entry"><span class="tag">micronutrients</span><div class="term-from">Kale smoothie</div><div class="arrow">↓</div><div class="term-to">Ugu &amp; pumpkin leaf soup</div></div>
        <div class="dict-entry"><span class="tag">breakfast</span><div class="term-from">Oats, dry, no toppings</div><div class="arrow">↓</div><div class="term-to">Akara &amp; pap</div></div>
        <div class="dict-entry"><span class="tag">protein</span><div class="term-from">Whey protein powder</div><div class="arrow">↓</div><div class="term-to">Soybeans, eggs, fish</div></div>
        <div class="dict-entry"><span class="tag">protein + fat</span><div class="term-from">Avocado toast</div><div class="arrow">↓</div><div class="term-to">Moi moi</div></div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="band band-tight reveal" id="features">
    <div class="wrap">
      <div class="section-head" style="margin-bottom:2.5rem;">
        <span class="eyebrow">What's inside</span>
        <h2>Built for the whole transformation, not just the meal plan.</h2>
      </div>
      <div class="feat-grid">
        <div class="feat-card"><span class="feat-idx">01</span><h3>A plan built for your goal</h3><p>Not generic "eat clean" advice — a plan for exactly what you're trying to change.</p></div>
        <div class="feat-card"><span class="feat-idx">02</span><h3>Exact numbers, not guesses</h3><p>Mifflin-St Jeor calorie &amp; macro math. Your body, your goal, your activity level.</p></div>
        <div class="feat-card"><span class="feat-idx">03</span><h3>You pick the meals</h3><p>Never handed a plan with food you hate. Choose what you'll actually eat.</p></div>
        <div class="feat-card"><span class="feat-idx">04</span><h3>Portions in exact grams</h3><p>No more eyeballing "a plate of rice." Know precisely how much to serve.</p></div>
        <div class="feat-card"><span class="feat-idx">05</span><h3>Live prep-method switching</h3><p>See how frying vs. boiling the same ingredient changes your calories — instantly.</p></div>
        <div class="feat-card"><span class="feat-idx">06</span><h3>Auto shopping list</h3><p>Walk into the market with an exact list. Stop forgetting or overbuying.</p></div>
        <div class="feat-card"><span class="feat-idx">07</span><h3>Gym or home workouts</h3><p>A structured plan matched to your goal — no more wondering what to do.</p></div>
        <div class="feat-card"><span class="feat-idx">08</span><h3>Community &amp; support</h3><p>Chat with people on the same journey, plus direct support from the Grainno team.</p></div>
      </div>
    </div>
  </section>

  <!-- CALCULATOR -->
  <section class="band reveal">
    <div class="wrap calc-wrap">
      <div class="calc-copy">
        <span class="eyebrow">See it work</span>
        <h2 style="margin-top:1.1rem;">The only meal planner that knows the difference between boiled and fried yam.</h2>
        <p class="lede">Frying vs. boiling the same ingredient changes its calories — nobody else shows you that. Tap a prep method and watch the numbers move.</p>
      </div>
      <div class="calc-card">
        <div class="calc-top"><span>Nutrition calculator</span><span>Per 100g</span></div>
        <div class="calc-ingredient">Yam</div>
        <div class="prep-toggle" role="group" aria-label="Prep method">
          <button class="prep-btn" data-prep="boiled" aria-pressed="true">Boiled</button>
          <button class="prep-btn" data-prep="roasted" aria-pressed="false">Roasted</button>
          <button class="prep-btn" data-prep="grilled" aria-pressed="false">Grilled</button>
          <button class="prep-btn" data-prep="fried" aria-pressed="false">Deep-fried</button>
        </div>
        <div class="calc-readout">
          <div class="calc-figure"><div class="num kcal" id="calcKcal">118</div><div class="label">Calories</div></div>
          <div class="calc-figure"><div class="num" id="calcProtein">2.1g</div><div class="label">Protein</div></div>
          <div class="calc-figure"><div class="num" id="calcCarbs">27g</div><div class="label">Carbs</div></div>
          <div class="calc-figure"><div class="num" id="calcFat">0.2g</div><div class="label">Fat</div></div>
        </div>
        <p class="calc-caption">Illustrative example. In the app, this recalculates live for every ingredient in your plan, scaled to your exact daily target.</p>
      </div>
    </div>
  </section>

  <!-- ARCHETYPES -->
  <section class="band band-tight reveal">
    <div class="wrap">
      <div class="section-head" style="margin-bottom:2.5rem;">
        <span class="eyebrow">Pick your lane</span>
        <h2>Which one's you?</h2>
      </div>
      <div class="arch-grid">
        <div class="arch-card"><h3>Weight Gainer</h3><p>You need calories, the right kind.</p></div>
        <div class="arch-card"><h3>Curve Seeker</h3><p>Build the shape you want, from the inside.</p></div>
        <div class="arch-card"><h3>Muscle Builder</h3><p>Pack on real muscle with African food.</p></div>
        <div class="arch-card"><h3>Healthy Eater</h3><p>More energy. Better body. Simple habits.</p></div>
        <div class="arch-card"><h3>Fat Burner</h3><p>Lose the fat, keep the muscle.</p></div>
      </div>
    </div>
  </section>

  <!-- MYTHS -->
  <section class="band reveal">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">Myth vs. fact</span>
        <h2>Let's kill the excuses.</h2>
      </div>
      <div class="myth-list">
        <div class="myth-item" data-open="true">
          <button class="myth-q"><span><span class="label">Myth</span><span class="txt">"Apetamin will give me curves."</span></span><span class="plus">+</span></button>
          <div class="myth-a"><div class="myth-a-inner"><span class="fact-label">Fact</span>Apetamin is an antihistamine that makes you drowsy and increases appetite. The weight it adds mostly goes to belly fat, not hips — and once you stop, it comes back.</div></div>
        </div>
        <div class="myth-item">
          <button class="myth-q"><span><span class="label">Myth</span><span class="txt">"Foreign protein powders are better than local food."</span></span><span class="plus">+</span></button>
          <div class="myth-a"><div class="myth-a-inner"><span class="fact-label">Fact</span>Soybeans have more protein per gram than many whey powders, and they're grown right here. Local beans, eggs, and fish will get you there.</div></div>
        </div>
        <div class="myth-item">
          <button class="myth-q"><span><span class="label">Myth</span><span class="txt">"Eating healthy in Africa is too expensive."</span></span><span class="plus">+</span></button>
          <div class="myth-a"><div class="myth-a-inner"><span class="fact-label">Fact</span>A day of healthy eating using beans, eggs, oats, and vegetables costs less than a plate of fast food.</div></div>
        </div>
        <div class="myth-item">
          <button class="myth-q"><span><span class="label">Myth</span><span class="txt">"My body type just can't change — it's genetics."</span></span><span class="plus">+</span></button>
          <div class="myth-a"><div class="myth-a-inner"><span class="fact-label">Fact</span>Genetics sets the ceiling, not the floor. Consistent nutrition and training can take most people much closer to their ceiling than they've ever been.</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section class="band band-tight reveal" id="pricing">
    <div class="wrap">
      <div class="section-head" style="margin-bottom:2.5rem;">
        <span class="eyebrow">Access</span>
        <h2>Start free. Upgrade when you're ready.</h2>
      </div>
      <div class="price-grid">
        <div class="price-card">
          <div class="price-head"><h3>Free</h3><span class="price-tag">₦0</span></div>
          <ul class="price-list">
            <li>5-minute quiz + full body assessment</li>
            <li>Meal-pool picker across all categories</li>
            <li>7 or 14-day plan generation</li>
            <li>Nutrition calculator with prep-method switching</li>
            <li>BMI &amp; calorie/macro calculator</li>
          </ul>
        </div>
        <div class="price-card featured">
          <div class="price-head"><h3>Premium</h3><span class="price-tag soon">Pricing coming soon</span></div>
          <ul class="price-list">
            <li>Everything in Free</li>
            <li>Batch-cook "advanced" meal plans</li>
            <li>Auto-generated shopping list</li>
            <li>Full workout plans with progressive overload</li>
            <li>Community chat + direct support</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="band reveal" id="faq">
    <div class="wrap">
      <div class="section-head" style="margin-bottom:2rem;">
        <span class="eyebrow">FAQ</span>
        <h2>Questions, answered.</h2>
      </div>
      <div class="faq-list">
        <div class="faq-item" data-open="true">
          <button class="faq-q"><span>Do I need to download anything from an app store?</span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner">No. GBT is a Progressive Web App — open it in your browser and add it to your home screen. It works like a native app, with no App Store or Play Store required.</div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span>Is the free tier actually useful, or just a teaser?</span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner">The free tier includes the full meal-pool picker, plan generation, and nutrition breakdown — the real product, not a watered-down demo.</div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span>What if I don't like the meals in my plan?</span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner">Edit your meal pool or regenerate a fresh plan any time. It's never stuck — it evolves with your taste and schedule.</div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span>Is this only for Nigerian food?</span><span class="txt"></span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner">The meal library spans African cuisine broadly — jollof, egusi, ogbono, amala, moi moi, suya, pepper soup, and more — not exclusively Nigerian dishes.</div></div>
        </div>
        <div class="faq-item">
          <button class="faq-q"><span>Can I cancel Premium anytime?</span><span class="plus">+</span></button>
          <div class="faq-a"><div class="faq-a-inner">Yes — no lock-in. Cancel anytime and keep using the free tier.</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- FINAL CTA -->
  <section class="band final-band reveal">
    <div class="wrap">
      <h2>Your body goal, <em>translated.</em></h2>
      <p class="lede">Take the quiz, get your numbers, and build a plan from food you already know how to cook.</p>
      <div class="hero-ctas">
        <a class="btn btn-primary" href="https://bodyrecomp.grainnofoods.com/quiz">Start the Quiz →</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="wrap">
      <div class="footer-top">
        <div>
          <a class="wordmark" href="<?php echo esc_url(home_url('/')); ?>">GBT<span>.</span></a>
          <p style="margin-top:0.7rem;color:var(--ink-faint);font-size:0.88rem;max-width:24rem;">Grainno Body Transformation — a product of Grainno Foods.</p>
        </div>
        <div class="footer-links">
          <a href="https://bodyrecomp.grainnofoods.com/quiz">Start the Quiz</a>
          <a href="https://bodyrecomp.grainnofoods.com">Explore the Tools</a>
          <a href="<?php echo esc_url(home_url('/')); ?>">Grainnofoods.com</a>
          <a href="<?php echo esc_url($wa_support_url); ?>" target="_blank" rel="noopener">WhatsApp Support</a>
        </div>
      </div>
      <div class="footer-bottom">
        <span>© GRAINNO FOODS</span>
        <span>MADE FOR AFRICAN BODIES</span>
      </div>
    </div>
  </footer>

</div>

<?php wp_footer(); ?>
</body>
</html>
