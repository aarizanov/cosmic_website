<div class="lktags-faq lktags-containter">

    <?php Pagup\Lktags\Core\Plugin::view('inc/top', compact('active_tab')); ?>

    <div class="faq-container">
        <div class="lktags-q">
            <?php echo esc_html__( 'What is the Linkedin insight tag ?', $text_domain ); ?>
        </div>
        <div class="lktags-a">
            <p>
                <?php echo esc_html__( 'The LinkedIn Insight Tag is a piece of lightweight JavaScript code you can easily drop on your website. It’s quick and easy to install, and unlocks robust campaign reporting, retargeting, and deeper insights about visitors.', $text_domain ); ?>
            </p>
        </div>
    </div>

    <div class="faq-container">
        <div class="lktags-q">
            <?php echo esc_html__( 'How to create an «event»?', $text_domain ); ?>
        </div>
        <div class="lktags-a">
            <p>
                <?php echo esc_html__( 'If you want to measure events or conversions on your website, you need to add an Insight tag to the “Thank You” page or by clicking a link or other ways. LinkedIn allows you to measure the following types of events:', $text_domain ); ?>
            </p>

            <ul>
                <li><?php echo esc_html__( 'Add to cart.', $text_domain ); ?></li>
                <li><?php echo esc_html__( 'Download.', $text_domain ); ?></li>
                <li><?php echo esc_html__( 'Install.', $text_domain ); ?></li>
                <li><?php echo esc_html__( 'Lead.', $text_domain ); ?></li>
                <li><?php echo esc_html__( 'Purchase.', $text_domain ); ?></li>
                <li><?php echo esc_html__( 'Sign up.', $text_domain ); ?></li>
                <li><?php echo esc_html__( 'Custom event.' ); ?></li>
            </ul>

            <p>
                <?php echo esc_html__( 'OR, for some specific needs, you can also add your Linkedin insight tag on all your web pages (with our main feature) and add a custom event pixel on a dedicated page with our Post META Box feature', $text_domain ); ?>
            </p>

        </div>
    </div>

    <div class="faq-container">
        <div class="lktags-q">
            <?php echo esc_html__( 'How to find the Linkedin Insight ID (partner ID) ?', $text_domain ); ?>
        </div>
        <div class="lktags-a">
            <p>
                <b><?php echo esc_html__( 'Log into the LinkedIn Campaign Manager.', $text_domain ); ?></b>
            </p>

            <p>
                <?php echo esc_html__( 'First, head to the LinkedIn Marketing Solutions page. From the “Advertising” dropdown menu, we’ll want to select “Sign in to Campaign Manager.” If you don’t have a LinkedIn business account, then sign up for one now. Once that’s complete, head into the Campaign Manager!', $text_domain ); ?>
            </p>
            <p>
                <b><?php echo esc_html__( 'Create an Ad Account.', $text_domain ); ?></b>
            </p>

            <p>
                <?php echo esc_html__( 'Next, create an Ad Account in order to access the LinkedIn Insight Tag. It will ask for some currency information, but no payment is currently required to access the Insight Tag. Once the Ad Account is created, it’s time to find the tag.', $text_domain ); ?>
            </p>

            <p>
                <b><?php echo esc_html__( 'Get the LinkedIn Data Partner ID.', $text_domain ); ?></b>
            </p>

            <p>
                <?php echo esc_html__( 'Inside of the Campaign Manager for the given Ad Account, open the “Account Assets” dropdown Menu. From there, select “Insight Tag” and move on to the specific tag! In the code that makes up the tag, find the variable named “_linkedin_data_partner_id” and get the number from that. In our case, it would be "21653" (for example) - however, make sure to use the number given directly inside of the tag! ', $text_domain ); ?>
            </p>
        </div>
    </div>

    <div class="faq-container">
        <div class="lktags-q">
            <?php echo esc_html__( 'How to make sure that the LinkedIn tag is properly added?', $text_domain ); ?>
        </div>
        <div class="lktags-a">
            <p>
                <?php echo esc_html__( 'To ensure that the LinkedIn tag has been properly implemented, you must add the domain for approval. To do this, go to the Insight Tag page, and on the right side, you must add your domain. WWW is not required. Once users enter your website, the tag will recognize and start running. At this point, you will see that LinkedIn has confirmed your domain.', $text_domain ); ?>
            </p>

        </div>
    </div>

</div>