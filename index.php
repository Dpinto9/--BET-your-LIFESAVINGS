<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BET your LIFESAVINGS</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <?php include 'php/html/header.php'; ?>

    <main>
        <section class="title">
            <h1>"Where luck meets laughter and wallets get lighter!"</h1>
            <img src="./img/slot.png" alt="">
        </section>
        <section class="main-section">
            <div class="grid-container">
                <!-- Top Row -->
                <div class="card card-medium">
                    <h3>Title 1</h3>
                    <p>Content for the first card. This card is larger in width and height.</p>
                </div>
                <div class="card card-small">
                    <h3>Title 2</h3>
                    <p>Content for the second card. This card is medium-sized.</p>
                </div>
                <div class="card card-large">
                    <h3>Title 3</h3>
                    <p>Content for the third card. This card is smaller in size.</p>
                </div>
        
                <!-- Second Row -->
                <div class="card card-small">
                    <h3>Title 4</h3>
                    <p>Content for the fourth card. This card is medium-sized.</p>
                </div>
                <div class="card card-medium">
                    <h3>Title 5</h3>
                    <p>Content for the fifth card. This card is larger in width and height.</p>
                </div>
               
            </div>
        </section>
        <section class="promotions-section">
            <hr class="br">
            <div class="scroller" data-speed="fast">
                <ul class="scroller__inner">
                    <li>100% match on the first deposit up to $500 + 50 free spins</li>
                    <li>$10 free credit just for signing up</li>
                    <li>50% bonus on every deposit made on weekends</li>
                    <li>20 free spins every Friday on the featured slot game</li>
                    <li>10% cashback on all losses incurred over the weekend</li>
                    <li>Earn points for every wager and redeem them for cash or prizes</li>
                    <li>Refer a friend and get $50 when they make their first deposit</li>
                    <li>Participate in weekly slot tournaments for a chance to win a share of a $10,000 prize pool</li>
                    <li>Christmas Special - 25 free spins and a 100% deposit bonus during the holiday season</li>
                    <li>Double your points on specific games every Tuesday</li>
                </ul>
            </div>
            <hr class="br">
        </section>

        <!-- Responsible Gaming Section -->
        <section class="responsible-gaming-section">
            <h2>Responsible Gaming</h2>
            <div class="responsible-gaming-content">
                <p>At our casino, we take responsible gaming seriously. Our aim is to provide a safe and enjoyable gaming environment. Here are some resources and tips for responsible gambling:</p>
                <ul>
                    <li>Set a budget and stick to it.</li>
                    <li>Take regular breaks while playing.</li>
                    <li>Never gamble with money you can't afford to lose.</li>
                    <li>Use self-exclusion tools if needed.</li>
                    <li>Seek help if you feel you may have a gambling problem. Resources include Gamblers Anonymous and national helplines.</li>
                </ul>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section">
            <h2>Testimonials</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p>"This site is amazing! I've lost so much money and that is great!"</p>
                    <span>- Freitas</span>
                </div>
                <div class="testimonial-card">
                    <p>"Best gaming experience ever! Highly recommend to everyone who wants to have a free life."</p>
                    <span>- Quaresma</span>
                </div>
                <div class="testimonial-card">
                    <p>"The bonuses are scamming asf, but the games are really fun."</p>
                    <span>- Eduardo</span>
                </div>
            </div>
        </section>


        
    </main>

    <?php include 'php/html/footer.php'; ?>

    <script>
        const scrollers = document.querySelectorAll(".scroller");

        // If a user hasn't opted in for recuded motion, then we add the animation
        if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        addAnimation();
        }

        function addAnimation() {
        scrollers.forEach((scroller) => {
            // add data-animated="true" to every `.scroller` on the page
            scroller.setAttribute("data-animated", true);

            // Make an array from the elements within `.scroller-inner`
            const scrollerInner = scroller.querySelector(".scroller__inner");
            const scrollerContent = Array.from(scrollerInner.children);

            // For each item in the array, clone it
            // add aria-hidden to it
            // add it into the `.scroller-inner`
            scrollerContent.forEach((item) => {
            const duplicatedItem = item.cloneNode(true);
            duplicatedItem.setAttribute("aria-hidden", true);
            scrollerInner.appendChild(duplicatedItem);
            });
        });
        }
    </script>
</body>
</html>
