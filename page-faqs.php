<?php
/**
 * Template Name: FAQs Page
 * Template for the Frequently Asked Questions page with tabbed navigation.
 */
get_header();
?>

    <?php get_template_part( 'template-parts/hero' ); ?>

    <div class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="bc-sep">›</span>
      <span class="cur">FAQs</span>
    </div>

   <?php echo do_shortcode('[dynamic_ticker]'); ?>

    <section class="faq-section faq-page">
      <div>
        <div class="faq-tabs" role="tablist" aria-label="FAQ Categories">
          <button class="faq-tab active" data-tab="general" role="tab" aria-selected="true">General</button>
          <button class="faq-tab" data-tab="charter" role="tab" aria-selected="false">38-Point Charter</button>
          <button class="faq-tab" data-tab="negotiations" role="tab" aria-selected="false">Negotiations</button>
          <button class="faq-tab" data-tab="electricity" role="tab" aria-selected="false">Electricity &amp; Tariffs</button>
          <button class="faq-tab" data-tab="involvement" role="tab" aria-selected="false">Get Involved</button>
          <button class="faq-tab" data-tab="diaspora" role="tab" aria-selected="false">Diaspora</button>
        </div>
      </div>
      <div>
        <div class="faq-category active" id="tab-general">
          <div class="category-head">
            <h2 class="faq-category-title">General <em>Questions</em></h2>
            <p class="faq-category-sub">Basic information about JKJAAC, its mission, and how the movement operates.</p>
          </div>
          <div class="faq-list">
            <div class="faq-item">
              <button class="faq-q open" aria-expanded="false">
                <span class="faq-q-text">What is JKJAAC?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a open">
                <div class="faq-a-inner">
                  <p>JKJAAC stands for Jammu Kashmir Joint Awami Action Committee. It is a broad-based civil society movement representing the people of Azad Jammu &amp; Kashmir (AJK), formed to demand economic justice, fair resource rights, and an end to elite privilege in the region.</p>
                  <p>The committee unites traders, transporters, lawyers, teachers, civil society organisations, and ordinary citizens across all three divisions of AJK — Muzaffarabad, Poonch, and Mirpur.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">When and how did the movement start?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>JKJAAC emerged in 2022 in response to soaring electricity bills and acute wheat flour shortages affecting the people of AJK. The protests began in Rawalakot — known as the Movement Birthplace — and quickly spread across the region.</p>
                  <p>What started as a protest against inflated utility bills grew into a comprehensive civil rights movement presenting a 38-Point Charter of Demands addressing the structural economic injustices facing AJK.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">What has JKJAAC achieved so far?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>JKJAAC has achieved significant milestones through peaceful civil resistance:</p>
                  <ul>
                    <li>₨23 Billion in financial relief secured in May 2024</li>
                    <li>31 of 37 core demands fulfilled as of 2026</li>
                    <li>Electricity tariff reforms benefiting thousands of households</li>
                    <li>Restoration of subsidized wheat flour supply</li>
                    <li>International attention raised through diaspora advocacy in the UK</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">Is JKJAAC a political party?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>No. JKJAAC is a civil society movement, not a political party. It does not contest elections or align with any specific political party. Its strength lies in its non-partisan, broad-based nature — bringing together citizens from all walks of life under a shared demand for economic rights and justice.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">How is JKJAAC structured?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>JKJAAC operates through a Central Committee based in Muzaffarabad with representation from all three divisions of AJK. It has divisional committees in Muzaffarabad, Poonch (Rawalakot), and Mirpur, as well as a UK Diaspora Chapter based in London and Bradford, led by Raja Amjad Ali Khan.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="faq-category" id="tab-charter">
          <div class="category-head">
            <h2 class="faq-category-title">38-Point <em>Charter</em></h2>
            <p class="faq-category-sub">Details about the comprehensive list of demands presented by JKJAAC to the government.</p>
          </div>
          <div class="faq-list">
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">What is the 38-Point Charter of Demands?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>The 38-Point Charter is a comprehensive list of economic and political demands put forward by JKJAAC on behalf of the people of Azad Jammu &amp; Kashmir. It covers a wide range of issues including electricity tariff reform, subsidized flour, abolition of elite privileges, resource rights, and improvements in public services.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">How many demands have been fulfilled?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>As of 2026, 31 out of 37 core demands have been fulfilled through sustained negotiations and civil pressure. JKJAAC continues to pursue the remaining outstanding demands with the same resolve that brought the earlier victories.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">What are the remaining unfulfilled demands?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>The outstanding demands primarily relate to structural reforms including long-term electricity pricing policy, expanded resource sovereignty for AJK, and comprehensive abolition of unjust elite perks. JKJAAC is actively pursuing these through ongoing negotiations. Visit the <a href="<?php echo esc_url( jkjaac_page_url( '38-point-charter' ) ); ?>" style="color: var(--gold)">38-Point Charter page</a> for the latest status of each demand.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="faq-category" id="tab-negotiations">
          <div class="category-head">
            <h2 class="faq-category-title">Negotiations &amp; <em>Talks</em></h2>
            <p class="faq-category-sub">How JKJAAC engages with government and what the negotiation process looks like.</p>
          </div>
          <div class="faq-list">
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">Who does JKJAAC negotiate with?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>JKJAAC negotiates directly with both the AJK government and the federal government of Pakistan. Given AJK's constitutional status, many key decisions — especially on electricity pricing and resource allocation — require federal-level agreement, which JKJAAC has successfully obtained in multiple rounds of talks.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">What is the current status of negotiations?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>Negotiations are ongoing. JKJAAC regularly meets with government representatives to track implementation of agreed demands and to press forward on unfulfilled ones. Visit the <a href="<?php echo esc_url( jkjaac_page_url( 'negotiations' ) ); ?>" style="color: var(--gold)">Negotiations page</a> for the most current updates on the status of talks.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">What happens if the government fails to implement agreements?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>JKJAAC reserves the right to resume civil resistance actions — including marches, shutdowns, and civil disobedience — if the government fails to honour its commitments. The movement has demonstrated this resolve on multiple occasions and the threat of mass mobilisation remains a key lever in ensuring accountability.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="faq-category" id="tab-electricity">
          <div class="category-head">
            <h2 class="faq-category-title">Electricity &amp; <em>Tariffs</em></h2>
            <p class="faq-category-sub">Understanding the electricity issue that was the founding grievance of the JKJAAC movement.</p>
          </div>
          <div class="faq-list">
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">Why is electricity such a central issue for AJK?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>AJK generates a substantial portion of Pakistan's hydroelectric power — including through the Mangla Dam — yet its own residents have historically been charged at rates far exceeding what the revenue from their resources would justify. This fundamental injustice — producing power for others while being unable to afford it locally — is what ignited the movement.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">What electricity tariff reforms has JKJAAC secured?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>Through sustained pressure and negotiations, JKJAAC secured significant reductions in electricity tariffs for AJK residents, part of the ₨23 Billion relief package agreed in May 2024. The movement continues to push for a permanent, fair pricing structure that reflects AJK's status as an energy-producing region.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">What is the significance of the Mirpur division in this issue?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>Mirpur is home to the Mangla Dam — one of the largest earth-filled dams in the world. Thousands of families were displaced when it was built and the region has borne the environmental and social costs ever since. Yet Mirpur residents pay the same inflated electricity rates as the rest of Pakistan, making it the heart of the electricity sovereignty issue.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="faq-category" id="tab-involvement">
          <div class="category-head">
            <h2 class="faq-category-title">Get <em>Involved</em></h2>
            <p class="faq-category-sub">How you can support the movement, volunteer, or contribute to the cause.</p>
          </div>
          <div class="faq-list">
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">How can I support JKJAAC?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>There are many ways to support the movement:</p>
                  <ul>
                    <li>Share our content and raise awareness on social media</li>
                    <li>Attend solidarity events in your city or region</li>
                    <li>Contact us to volunteer in media, translation, or legal support roles</li>
                    <li>If you are in the diaspora, lobby your local MPs and representatives</li>
                    <li>Contribute to our media archive by sharing documents and recordings</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">Can people outside AJK support the movement?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>Absolutely. Solidarity from Pakistanis and the international community is welcome and vital. Whether you are from Pakistan, the UK, Europe, or anywhere in the world, you can follow our campaigns, share our message, and advocate for economic justice for the people of AJK.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">How can I contact JKJAAC directly?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>You can reach us through our <a href="<?php echo esc_url( jkjaac_page_url( 'contact' ) ); ?>" style="color: var(--gold)">Contact page</a> for media inquiries, solidarity messages, archive contributions, legal support requests, or diaspora chapter contact. We respond within 24 hours on working days.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="faq-category" id="tab-diaspora">
          <div class="category-head">
            <h2 class="faq-category-title">Diaspora <em>Chapter</em></h2>
            <p class="faq-category-sub">Information about JKJAAC's UK Diaspora Chapter and international outreach.</p>
          </div>
          <div class="faq-list">
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">What is the UK Diaspora Chapter?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>The UK Diaspora Chapter is based in London and Bradford, led by Raja Amjad Ali Khan. It organises solidarity protests, lobbies British MPs, conducts international outreach, and raises awareness about the economic justice movement in AJK among the large Kashmiri diaspora community in the United Kingdom.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">Why does the UK diaspora play such an important role?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>The UK is home to one of the largest Kashmiri communities outside of South Asia, with particularly strong ties to the Mirpur region. This community has significant political influence through its engagement with British MPs and Lords. Diaspora advocacy has helped internationalise the movement and created diplomatic pressure that strengthens the negotiating position of JKJAAC inside Pakistan.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">Are there diaspora chapters in other countries?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>Currently, the formal diaspora chapter is in the UK. However, JKJAAC welcomes outreach and solidarity from Kashmiris and their supporters worldwide. If you are interested in forming or joining a solidarity group in your country, please reach out through our <a href="<?php echo esc_url( jkjaac_page_url( 'contact' ) ); ?>" style="color: var(--gold)">Contact page</a>.</p>
                </div>
              </div>
            </div>
            <div class="faq-item">
              <button class="faq-q" aria-expanded="false">
                <span class="faq-q-text">How does the Kashmir issue relate to international law?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-a">
                <div class="faq-a-inner">
                  <p>The Kashmir dispute is backed by more than 12 UN Security Council resolutions calling for a plebiscite to determine the region's future. The abrogation of Article 370 by India in August 2019 further intensified international focus on the region. JKJAAC situates its economic rights struggle within this broader framework of self-determination and international law.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

   <?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>
