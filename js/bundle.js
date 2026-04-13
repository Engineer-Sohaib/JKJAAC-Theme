class NavigationManager {
  constructor(options = {}) {
    // Configuration
    this.config = {
      navId: options.navId || "nav",
      toggleId: options.toggleId || "navToggle",
      linksClass: options.linksClass || "nav-links",
      overlayClass: options.overlayClass || "nav-overlay",
      dropdownClass: options.dropdownClass || "has-dropdown",
      scrollThreshold: options.scrollThreshold || 40,
      mobileBreakpoint: options.mobileBreakpoint || 900,
      ...options,
    };

    // DOM Elements
    this.nav = null;
    this.toggle = null;
    this.links = null;
    this.overlay = null;

    // State
    this.isMenuOpen = false;
    this.scrollHandler = null;
    this.resizeHandler = null;
    this.keydownHandler = null;

    // Bind methods
    this.openMenu = this.openMenu.bind(this);
    this.closeMenu = this.closeMenu.bind(this);
    this.handleScroll = this.handleScroll.bind(this);
    this.handleResize = this.handleResize.bind(this);
    this.handleKeydown = this.handleKeydown.bind(this);
    this.handleToggleClick = this.handleToggleClick.bind(this);
    this.handleLinkClick = this.handleLinkClick.bind(this);
    this.handleDropdownClick = this.handleDropdownClick.bind(this);

    // Initialize
    this.init();
  }

  init() {
    this.getElements();
    if (!this.nav) return;

    this.createOverlay();
    this.attachEventListeners();
    this.handleResize();
  }

  getElements() {
    this.nav = document.getElementById(this.config.navId);
    this.toggle = document.getElementById(this.config.toggleId);
    this.links = document.querySelector(`.${this.config.linksClass}`);
  }

  createOverlay() {
    this.overlay = document.createElement("div");
    this.overlay.className = this.config.overlayClass;
    document.body.appendChild(this.overlay);
    this.overlay.addEventListener("click", this.closeMenu);
  }

  attachEventListeners() {
    // Scroll handler
    this.scrollHandler = this.handleScroll;
    window.addEventListener("scroll", this.scrollHandler);

    // Resize handler
    this.resizeHandler = this.handleResize;
    window.addEventListener("resize", this.resizeHandler);

    // Keyboard handler
    this.keydownHandler = this.handleKeydown;
    document.addEventListener("keydown", this.keydownHandler);

    // Toggle button
    if (this.toggle) {
      this.toggle.addEventListener("click", this.handleToggleClick);
    }

    // Links
    if (this.links) {
      this.links.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", this.handleLinkClick);
      });
    }

    // Dropdowns
    this.attachDropdownListeners();
  }

  attachDropdownListeners() {
    const dropdowns = document.querySelectorAll(
      `.${this.config.dropdownClass} > a`,
    );
    dropdowns.forEach((link) => {
      link.removeEventListener("click", this.handleDropdownClick);
      link.addEventListener("click", this.handleDropdownClick);
    });
  }

  handleScroll() {
    const shouldScroll = window.scrollY > this.config.scrollThreshold;
    this.nav.classList.toggle("scrolled", shouldScroll);
  }

  handleResize() {
    if (window.innerWidth > this.config.mobileBreakpoint && this.isMenuOpen) {
      this.closeMenu();
    }
  }

  handleKeydown(event) {
    if (event.key === "Escape" && this.isMenuOpen) {
      this.closeMenu();
    }
  }

  handleToggleClick() {
    if (this.isMenuOpen) {
      this.closeMenu();
    } else {
      this.openMenu();
    }
  }

  handleLinkClick(event) {
    const link = event.currentTarget;
    const isInDropdown = link.closest(`.${this.config.dropdownClass}`);
    const isParentDropdown = link.parentElement?.classList?.contains(
      this.config.dropdownClass,
    );

    if (!isInDropdown || !isParentDropdown) {
      this.closeMenu();
    }
  }

  handleDropdownClick(event) {
    if (window.innerWidth <= this.config.mobileBreakpoint) {
      event.preventDefault();
      const dropdown = event.currentTarget.closest(
        `.${this.config.dropdownClass}`,
      );
      if (dropdown) {
        dropdown.classList.toggle("open");
      }
    }
  }

  openMenu() {
    if (!this.nav || !this.toggle) return;

    this.isMenuOpen = true;
    this.nav.classList.add("menu-open");

    if (this.links) {
      this.links.classList.add("open");
    }

    this.toggle.classList.add("active");
    this.toggle.setAttribute("aria-expanded", "true");

    if (this.overlay) {
      this.overlay.classList.add("active");
    }

    document.body.style.overflow = "hidden";
  }

  closeMenu() {
    if (!this.nav || !this.toggle) return;

    this.isMenuOpen = false;
    this.nav.classList.remove("menu-open");

    if (this.links) {
      this.links.classList.remove("open");
    }

    this.toggle.classList.remove("active");
    this.toggle.setAttribute("aria-expanded", "false");

    if (this.overlay) {
      this.overlay.classList.remove("active");
    }

    document.body.style.overflow = "";

    // Close all dropdowns
    this.closeAllDropdowns();
  }

  closeAllDropdowns() {
    const openDropdowns = document.querySelectorAll(
      `.${this.config.dropdownClass}.open`,
    );
    openDropdowns.forEach((dropdown) => {
      dropdown.classList.remove("open");
    });
  }

  refresh() {
    this.attachDropdownListeners();
  }

  destroy() {
    // Remove event listeners
    window.removeEventListener("scroll", this.scrollHandler);
    window.removeEventListener("resize", this.resizeHandler);
    document.removeEventListener("keydown", this.keydownHandler);

    if (this.toggle) {
      this.toggle.removeEventListener("click", this.handleToggleClick);
    }

    if (this.links) {
      this.links.querySelectorAll("a").forEach((link) => {
        link.removeEventListener("click", this.handleLinkClick);
      });
    }

    const dropdowns = document.querySelectorAll(
      `.${this.config.dropdownClass} > a`,
    );
    dropdowns.forEach((link) => {
      link.removeEventListener("click", this.handleDropdownClick);
    });

    // Remove overlay
    if (this.overlay && this.overlay.parentNode) {
      this.overlay.removeEventListener("click", this.closeMenu);
      this.overlay.parentNode.removeChild(this.overlay);
    }

    // Reset body styles
    if (this.isMenuOpen) {
      document.body.style.overflow = "";
    }
  }
}

class ScrollRevealManager {
  constructor(options = {}) {
    // Configuration
    this.config = {
      srSelector: options.srSelector || ".sr",
      srClassName: options.srClassName || "in",
      srThreshold: options.srThreshold || 0.07,
      srRootMargin: options.srRootMargin || "0px 0px -30px 0px",

      revealSelector: options.revealSelector || ".reveal",
      revealClassName: options.revealClassName || "visible",
      revealThreshold: options.revealThreshold || 0.1,
      revealRootMargin: options.revealRootMargin || "0px 0px -40px 0px",

      ...options,
    };

    this.srObserver = null;
    this.revealObserver = null;

    // Bind methods
    this.handleSrIntersect = this.handleSrIntersect.bind(this);
    this.handleRevealIntersect = this.handleRevealIntersect.bind(this);

    this.init();
  }

  init() {
    this.setupSrObserver();
    this.setupRevealObserver();
    this.observeElements();
  }

  setupSrObserver() {
    this.srObserver = new IntersectionObserver(this.handleSrIntersect, {
      threshold: this.config.srThreshold,
      rootMargin: this.config.srRootMargin,
    });
  }

  setupRevealObserver() {
    this.revealObserver = new IntersectionObserver(this.handleRevealIntersect, {
      threshold: this.config.revealThreshold,
      rootMargin: this.config.revealRootMargin,
    });
  }

  handleSrIntersect(entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add(this.config.srClassName);
        this.srObserver.unobserve(entry.target);
      }
    });
  }

  handleRevealIntersect(entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add(this.config.revealClassName);
        this.revealObserver.unobserve(entry.target);
      }
    });
  }

  observeElements() {
    document.querySelectorAll(this.config.srSelector).forEach((el) => {
      this.srObserver.observe(el);
    });

    document.querySelectorAll(this.config.revealSelector).forEach((el) => {
      this.revealObserver.observe(el);
    });
  }

  addElements(elements, type = "sr") {
    const elementsArray =
      elements instanceof NodeList ? Array.from(elements) : [elements];

    const observer = type === "sr" ? this.srObserver : this.revealObserver;
    const selector =
      type === "sr" ? this.config.srSelector : this.config.revealSelector;

    elementsArray.forEach((el) => {
      if (el instanceof Element && el.matches(selector)) {
        observer.observe(el);
      }
    });
  }

  refresh() {
    this.srObserver.disconnect();
    this.revealObserver.disconnect();

    this.setupSrObserver();
    this.setupRevealObserver();
    this.observeElements();
  }

  destroy() {
    if (this.srObserver) this.srObserver.disconnect();
    if (this.revealObserver) this.revealObserver.disconnect();
  }
}

class AdvancedProgressBarManager {
  constructor(options = {}) {
    this.config = {
      containerSelector: ".bar-stats",
      barSelector: ".bs-fill",
      threshold: 0.3,
      animationDelay: 100,
      resetOnExit: false,
      once: true,
      animationEasing: "ease-out",
      animationDuration: "0.6s",
      onComplete: null,
      onContainerAnimate: null,
      onBarAnimate: null,
      debug: false,
      ...options,
    };

    this.observer = null;
    this.animatedContainers = new Map();
    this.animationFrameIds = new Map();

    this.init();
  }

  init() {
    if (!this.hasBars()) return;

    this.setupObserver();
    this.observeContainers();
    this.setupStyles();
  }

  hasBars() {
    return document.querySelector(this.config.barSelector) !== null;
  }

  setupStyles() {
    // Add transition styles dynamically
    const style = document.createElement("style");
    style.textContent = `
      ${this.config.barSelector} {
        transition: width ${this.config.animationDuration} ${this.config.animationEasing};
      }
    `;
    document.head.appendChild(style);
  }

  setupObserver() {
    this.observer = new IntersectionObserver(this.handleIntersect.bind(this), {
      threshold: this.config.threshold,
      rootMargin: this.config.rootMargin || "0px",
    });
  }

  handleIntersect(entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        this.animateContainer(entry.target);
      } else if (this.config.resetOnExit) {
        this.resetContainer(entry.target);
      }
    });
  }

  animateContainer(container) {
    // Check if already animated
    if (this.config.once && this.animatedContainers.has(container)) {
      return;
    }

    const bars = container.querySelectorAll(this.config.barSelector);

    if (bars.length === 0) return;

    // Store animation data
    const animationData = {
      animated: true,
      timestamp: Date.now(),
      barsCount: bars.length,
    };
    this.animatedContainers.set(container, animationData);

    // Animate bars
    const animations = [];
    bars.forEach((bar, index) => {
      const animation = this.animateBar(bar, index, bars.length);
      animations.push(animation);
    });

    // Trigger callbacks
    if (this.config.onContainerAnimate) {
      this.config.onContainerAnimate(container, animationData);
    }

    // Wait for all animations to complete
    Promise.all(animations).then(() => {
      if (this.config.onComplete) {
        this.config.onComplete(container, animationData);
      }
    });
  }

  animateBar(bar, index, totalBars) {
    return new Promise((resolve) => {
      const targetWidth = bar.dataset.width;

      if (!targetWidth) {
        resolve();
        return;
      }

      if (this.animationFrameIds.has(bar)) {
        clearTimeout(this.animationFrameIds.get(bar));
      }

      bar.style.width = "0";

      bar.setAttribute("data-animated", "false");

      const delay = this.config.staggerDelay
        ? this.config.animationDelay + index * this.config.staggerDelay
        : this.config.animationDelay;

      const timeoutId = setTimeout(() => {
        bar.style.width = targetWidth;
        bar.setAttribute("data-animated", "true");

        if (this.config.onBarAnimate) {
          this.config.onBarAnimate(bar, { targetWidth, index, totalBars });
        }

        resolve();
      }, delay);

      this.animationFrameIds.set(bar, timeoutId);
    });
  }

  resetContainer(container) {
    const bars = container.querySelectorAll(this.config.barSelector);

    bars.forEach((bar) => {
      if (this.animationFrameIds.has(bar)) {
        clearTimeout(this.animationFrameIds.get(bar));
        this.animationFrameIds.delete(bar);
      }

      bar.style.width = "0";
      bar.setAttribute("data-animated", "false");
    });

    this.animatedContainers.delete(container);
  }

  observeContainers() {
    const containers = document.querySelectorAll(this.config.containerSelector);

    containers.forEach((container) => {
      this.observer.observe(container);
    });
  }

  addContainers(containers) {
    const containersArray =
      containers instanceof NodeList ? Array.from(containers) : [containers];

    containersArray.forEach((container) => {
      if (container instanceof Element) {
        this.observer.observe(container);
      }
    });
  }

  refresh() {
    this.observer.disconnect();
    this.animatedContainers.clear();

    // Clear all pending animations
    this.animationFrameIds.forEach((timeoutId) => {
      clearTimeout(timeoutId);
    });
    this.animationFrameIds.clear();

    this.setupObserver();
    this.observeContainers();
  }

  destroy() {
    if (this.observer) {
      this.observer.disconnect();
    }

    this.animationFrameIds.forEach((timeoutId) => {
      clearTimeout(timeoutId);
    });
    this.animationFrameIds.clear();

    this.animatedContainers.clear();
  }
}

class FAQAccordion {
  constructor(options = {}) {
    this.config = {
      questionSelector: options.questionSelector || ".faq-q",
      answerSelector: options.answerSelector || ".faq-a",
      activeClass: options.activeClass || "open",
      ...options,
    };

    this.questions = null;
    this.init();
  }

  init() {
    this.questions = document.querySelectorAll(this.config.questionSelector);
    if (!this.questions.length) return;

    this.attachEventListeners();
  }

  attachEventListeners() {
    this.questions.forEach((btn) => {
      btn.addEventListener("click", this.handleClick.bind(this));
    });
  }

  handleClick(event) {
    const btn = event.currentTarget;
    const isOpen = btn.classList.contains(this.config.activeClass);

    document.querySelectorAll(this.config.questionSelector).forEach((b) => {
      b.classList.remove(this.config.activeClass);
    });

    document.querySelectorAll(this.config.answerSelector).forEach((a) => {
      a.classList.remove(this.config.activeClass);
    });

    if (!isOpen) {
      btn.classList.add(this.config.activeClass);
      btn.nextElementSibling.classList.add(this.config.activeClass);
    }
  }

  refresh() {
    this.init();
  }

  destroy() {
    this.questions.forEach((btn) => {
      btn.removeEventListener("click", this.handleClick);
    });
  }
}

class FAQTabController {
  constructor(options = {}) {
    this.config = {
      tabSelector: options.tabSelector || ".faq-tab",
      categorySelector: options.categorySelector || ".faq-category",
      activeClass: options.activeClass || "active",
      offset: options.offset || 120, // sticky header offset
      ...options,
    };

    this.tabs = null;
    this.categories = null;
    this.isClickScrolling = false;

    this.init();
  }

  init() {
    this.tabs = document.querySelectorAll(this.config.tabSelector);
    this.categories = document.querySelectorAll(this.config.categorySelector);

    if (!this.tabs.length || !this.categories.length) return;

    this.attachTabClicks();
    this.attachScrollSpy();
  }

  attachTabClicks() {
    this.tabs.forEach((tab) => {
      tab.addEventListener("click", (e) => {
        const targetId = `tab-${tab.dataset.tab}`;
        const targetEl = document.getElementById(targetId);

        if (!targetEl) return;

        this.isClickScrolling = true;
        this.setActiveTab(tab);

        const top =
          targetEl.getBoundingClientRect().top +
          window.scrollY -
          this.config.offset;

        window.scrollTo({ top, behavior: "smooth" });

        // Release scroll-spy lock after animation
        clearTimeout(this.scrollTimer);
        this.scrollTimer = setTimeout(() => {
          this.isClickScrolling = false;
        }, 800);
      });
    });
  }

  attachScrollSpy() {
    const observer = new IntersectionObserver(
      (entries) => {
        if (this.isClickScrolling) return;

        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const id = entry.target.id; // e.g. "tab-general"
            const tabKey = id.replace("tab-", "");
            const matchingTab = [...this.tabs].find(
              (t) => t.dataset.tab === tabKey,
            );

            if (matchingTab) this.setActiveTab(matchingTab);
          }
        });
      },
      {
        rootMargin: `-${this.config.offset}px 0px -50% 0px`,
        threshold: 0,
      },
    );

    this.categories.forEach((cat) => observer.observe(cat));
    this.observer = observer;
  }

  setActiveTab(activeTab) {
    this.tabs.forEach((t) => {
      t.classList.remove(this.config.activeClass);
      t.setAttribute("aria-selected", "false");
    });

    activeTab.classList.add(this.config.activeClass);
    activeTab.setAttribute("aria-selected", "true");
  }

  destroy() {
    this.observer?.disconnect();
  }
}

class SubjectPillNavigation {
  constructor(options = {}) {
    this.config = {
      pillsSelector: options.pillsSelector || ".subject-pill",
      activeClass: options.activeClass || "active",
      allowMultiple: options.allowMultiple || false,
      persistState: options.persistState || false,
      storageKey: options.storageKey || "subject-pill-active",
      onPillChange: options.onPillChange || null,
      debugMode: options.debugMode || false,
      ...options,
    };

    // DOM elements
    this.pills = [];
    this.activePills = [];

    this.isInitialized = false;
    this.eventHandler = null;

    // Bind methods
    this.handlePillClick = this.handlePillClick.bind(this);
    this.setActive = this.setActive.bind(this);
    this.getActive = this.getActive.bind(this);
    this.reset = this.reset.bind(this);
    this.destroy = this.destroy.bind(this);

    // Initialize
    this.init();
  }

  init() {
    this.cachePills();

    if (!this.validateElements()) {
      return;
    }

    this.attachEventListeners();
    this.loadPersistedState();
    this.isInitialized = true;
  }

  cachePills() {
    this.pills = Array.from(
      document.querySelectorAll(this.config.pillsSelector),
    );
  }

  validateElements() {
    if (this.pills.length === 0) {
      return false;
    }
    return true;
  }

  attachEventListeners() {
    this.pills.forEach((pill) => {
      pill.removeEventListener("click", this.handlePillClick);
      pill.addEventListener("click", this.handlePillClick);
    });
  }

  handlePillClick(event) {
    const clickedPill = event.currentTarget;

    if (this.config.allowMultiple) {
      this.handleMultipleSelection(clickedPill);
    } else {
      this.handleSingleSelection(clickedPill);
    }

    if (
      this.config.onPillChange &&
      typeof this.config.onPillChange === "function"
    ) {
      this.config.onPillChange(this.getActive(), clickedPill);
    }

    this.dispatchChangeEvent(clickedPill);

    if (this.config.persistState) {
      this.persistState();
    }
  }

  handleSingleSelection(clickedPill) {
    this.pills.forEach((pill) => {
      pill.classList.remove(this.config.activeClass);
    });

    clickedPill.classList.add(this.config.activeClass);
    this.activePills = [clickedPill];
  }

  handleMultipleSelection(clickedPill) {
    const isActive = clickedPill.classList.contains(this.config.activeClass);

    if (isActive) {
      clickedPill.classList.remove(this.config.activeClass);
      this.activePills = this.activePills.filter(
        (pill) => pill !== clickedPill,
      );
    } else {
      clickedPill.classList.add(this.config.activeClass);
      this.activePills.push(clickedPill);
    }
  }

  setActive(pillOrIndex, activate = true) {
    let targetPill = null;

    if (typeof pillOrIndex === "number") {
      if (pillOrIndex >= 0 && pillOrIndex < this.pills.length) {
        targetPill = this.pills[pillOrIndex];
      } else {
        return false;
      }
    } else if (typeof pillOrIndex === "string") {
      targetPill = this.pills.find(
        (pill) =>
          pill.textContent.trim() === pillOrIndex ||
          pill.getAttribute("data-value") === pillOrIndex,
      );
    } else if (pillOrIndex instanceof Element) {
      targetPill = pillOrIndex;
    }

    if (!targetPill) {
      return false;
    }

    if (this.config.allowMultiple) {
      if (activate && !targetPill.classList.contains(this.config.activeClass)) {
        targetPill.classList.add(this.config.activeClass);
        this.activePills.push(targetPill);
      } else if (
        !activate &&
        targetPill.classList.contains(this.config.activeClass)
      ) {
        targetPill.classList.remove(this.config.activeClass);
        this.activePills = this.activePills.filter(
          (pill) => pill !== targetPill,
        );
      }
    } else {
      if (activate) {
        this.pills.forEach((pill) => {
          pill.classList.remove(this.config.activeClass);
        });
        targetPill.classList.add(this.config.activeClass);
        this.activePills = [targetPill];
      }
    }

    this.dispatchChangeEvent(targetPill);

    if (this.config.persistState) {
      this.persistState();
    }

    return true;
  }

  getActive() {
    if (this.config.allowMultiple) {
      return this.activePills;
    } else {
      return this.activePills[0] || null;
    }
  }

  getActiveValues() {
    const activePills = this.getActive();

    if (this.config.allowMultiple) {
      return activePills.map((pill) => this.getPillValue(pill));
    } else {
      return activePills ? this.getPillValue(activePills) : null;
    }
  }

  getPillValue(pill) {
    return pill.getAttribute("data-value") || pill.textContent.trim();
  }

  isActive(pillOrIndex) {
    let targetPill = null;

    if (typeof pillOrIndex === "number") {
      targetPill = this.pills[pillOrIndex];
    } else if (typeof pillOrIndex === "string") {
      targetPill = this.pills.find(
        (pill) =>
          pill.textContent.trim() === pillOrIndex ||
          pill.getAttribute("data-value") === pillOrIndex,
      );
    } else if (pillOrIndex instanceof Element) {
      targetPill = pillOrIndex;
    }

    return targetPill
      ? targetPill.classList.contains(this.config.activeClass)
      : false;
  }

  reset() {
    this.pills.forEach((pill) => {
      pill.classList.remove(this.config.activeClass);
    });
    this.activePills = [];

    if (this.config.persistState) {
      this.clearPersistedState();
    }

    this.dispatchChangeEvent(null);
  }

  clear() {
    this.reset();
  }

  loadPersistedState() {
    if (!this.config.persistState) return;

    try {
      const savedState = localStorage.getItem(this.config.storageKey);
      if (savedState) {
        const activeIndices = JSON.parse(savedState);

        if (this.config.allowMultiple) {
          activeIndices.forEach((index) => {
            if (this.pills[index]) {
              this.setActive(index, true);
            }
          });
        } else {
          if (activeIndices.length > 0 && this.pills[activeIndices[0]]) {
            this.setActive(activeIndices[0], true);
          }
        }
      }
    } catch (error) {}
  }

  persistState() {
    if (!this.config.persistState) return;

    try {
      const activeIndices = this.pills.reduce((indices, pill, index) => {
        if (pill.classList.contains(this.config.activeClass)) {
          indices.push(index);
        }
        return indices;
      }, []);

      localStorage.setItem(
        this.config.storageKey,
        JSON.stringify(activeIndices),
      );
    } catch (error) {}
  }

  clearPersistedState() {
    if (!this.config.persistState) return;

    try {
      localStorage.removeItem(this.config.storageKey);
    } catch (error) {}
  }

  dispatchChangeEvent(triggerPill) {
    const event = new CustomEvent("subjectPillChange", {
      detail: {
        activePills: this.getActiveValues(),
        activePillsElements: this.getActive(),
        triggerPill: triggerPill,
        timestamp: new Date(),
        multiple: this.config.allowMultiple,
      },
    });
    document.dispatchEvent(event);
  }

  refresh() {
    this.cachePills();
    this.attachEventListeners();
    this.loadPersistedState();
  }

  addPill(pillElement, activate = false) {
    if (!(pillElement instanceof Element)) {
      return false;
    }

    this.pills.push(pillElement);
    pillElement.addEventListener("click", this.handlePillClick);

    if (activate) {
      this.setActive(pillElement, true);
    }

    return true;
  }

  removePill(pillOrIndex) {
    let targetPill = null;
    let targetIndex = -1;

    if (typeof pillOrIndex === "number") {
      targetIndex = pillOrIndex;
      targetPill = this.pills[targetIndex];
    } else if (pillOrIndex instanceof Element) {
      targetPill = pillOrIndex;
      targetIndex = this.pills.indexOf(targetPill);
    }

    if (!targetPill || targetIndex === -1) {
      return false;
    }

    targetPill.removeEventListener("click", this.handlePillClick);
    this.pills.splice(targetIndex, 1);

    if (this.activePills.includes(targetPill)) {
      this.activePills = this.activePills.filter((pill) => pill !== targetPill);
    }

    return true;
  }

  getPillsData() {
    return this.pills.map((pill, index) => ({
      index: index,
      element: pill,
      text: pill.textContent.trim(),
      value: this.getPillValue(pill),
      isActive: pill.classList.contains(this.config.activeClass),
    }));
  }

  destroy() {
    this.pills.forEach((pill) => {
      pill.removeEventListener("click", this.handlePillClick);
    });

    this.pills = [];
    this.activePills = [];
    this.isInitialized = false;
  }
}

function createSubjectPillNavigation(options = {}) {
  return new SubjectPillNavigation(options);
}

class ContactFormHandler {
  constructor(options = {}) {
    this.config = {
      formId: options.formId || "contactForm",
      formSelector: options.formSelector || null,
      wrapElementId: options.wrapElementId || "formWrap",
      successElementId: options.successElementId || "formSuccess",
      successClass: options.successClass || "show",
      hideWrapOnSuccess: options.hideWrapOnSuccess !== false,
      validateForm: options.validateForm !== false,
      submitUrl: options.submitUrl || null,
      submitMethod: options.submitMethod || "POST",
      useAjax: options.useAjax || true,
      resetOnSuccess: options.resetOnSuccess || false,
      autoHideSuccess: options.autoHideSuccess || false,
      autoHideDelay: options.autoHideDelay || 5000,
      onSuccess: options.onSuccess || null,
      onError: options.onError || null,
      onValidationError: options.onValidationError || null,
      debugMode: options.debugMode || false,
      ...options,
    };

    this.form = null;
    this.wrapElement = null;
    this.successElement = null;
    this.submitButton = null;
    this.subjectInput = null;

    this.isSubmitting = false;
    this.isInitialized = false;

    this.handleSubmit = this.handleSubmit.bind(this);
    this.validateForm = this.validateForm.bind(this);
    this.showSuccess = this.showSuccess.bind(this);
    this.hideSuccess = this.hideSuccess.bind(this);
    this.resetForm = this.resetForm.bind(this);
    this.destroy = this.destroy.bind(this);

    this.init();
  }

  init() {
    this.cacheElements();

    if (!this.validateElements()) {
      return;
    }

    this.attachEventListeners();
    this.setupInitialState();
    this.isInitialized = true;
  }

  cacheElements() {
    if (this.config.formId) {
      this.form = document.getElementById(this.config.formId);
    } else if (this.config.formSelector) {
      this.form = document.querySelector(this.config.formSelector);
    }

    if (this.config.wrapElementId) {
      this.wrapElement = document.getElementById(this.config.wrapElementId);
    }

    if (this.config.successElementId) {
      this.successElement = document.getElementById(
        this.config.successElementId,
      );
    }

    if (this.form) {
      this.submitButton = this.form.querySelector('button[type="submit"]');
      this.subjectInput = this.form.querySelector('input[name="subject"]');
    }
  }

  validateElements() {
    if (!this.form) {
      return false;
    }

    if (this.config.hideWrapOnSuccess && !this.wrapElement) {
      this.config.hideWrapOnSuccess = false;
    }

    return true;
  }

  attachEventListeners() {
    this.form.removeEventListener("submit", this.handleSubmit);
    this.form.addEventListener("submit", this.handleSubmit);
  }

  setupInitialState() {
    if (this.successElement) {
      this.successElement.classList.remove(this.config.successClass);
    }
  }

  getSelectedSubject() {
    const activePill = document.querySelector('.subject-pill.active');
    return activePill ? activePill.textContent.trim() : 'General';
  }

  updateSubjectInput() {
    if (this.subjectInput) {
      this.subjectInput.value = this.getSelectedSubject();
    }
  }

  async handleSubmit(event) {
    event.preventDefault();

    if (this.isSubmitting) {
      return;
    }

    // Update subject from active pill
    this.updateSubjectInput();

    if (this.config.validateForm) {
      const isValid = this.validateForm();
      if (!isValid) {
        if (this.config.onValidationError) {
          this.config.onValidationError(this.getFormData());
        }
        return;
      }
    }

    this.isSubmitting = true;
    this.disableSubmitButton(true);
    this.clearFormError();

    try {
      let result;
      
      if (this.config.useAjax) {
        result = await this.ajaxSubmit();
      } else if (this.config.submitUrl) {
        result = await this.ajaxSubmit();
      } else {
        await this.simulateSubmission();
      }

      this.showSuccess();

      if (this.config.resetOnSuccess) {
        this.resetForm();
      }

      if (this.config.onSuccess) {
        this.config.onSuccess(this.getFormData(), result);
      }
    } catch (error) {
      if (this.config.onError) {
        this.config.onError(error, this.getFormData());
      }

      this.showError(error.message);
    } finally {
      this.isSubmitting = false;
      this.disableSubmitButton(false);
    }
  }

  validateForm() {
    const formData = this.getFormData();
    const errors = [];

    // Clear previous errors
    this.clearFieldErrors();

    if (!formData.fname || formData.fname.trim() === "") {
      errors.push({
        field: "fname",
        message: "First name is required",
      });
      this.markFieldInvalid("fname", "First name is required");
    } else {
      this.markFieldValid("fname");
    }

    if (!formData.lname || formData.lname.trim() === "") {
      errors.push({
        field: "lname",
        message: "Last name is required",
      });
      this.markFieldInvalid("lname", "Last name is required");
    } else {
      this.markFieldValid("lname");
    }

    if (!formData.email || formData.email.trim() === "") {
      errors.push({
        field: "email",
        message: "Email address is required",
      });
      this.markFieldInvalid("email", "Email address is required");
    } else if (!this.isValidEmail(formData.email)) {
      errors.push({
        field: "email",
        message: "Please enter a valid email address",
      });
      this.markFieldInvalid("email", "Please enter a valid email address");
    } else {
      this.markFieldValid("email");
    }

    if (!formData.message || formData.message.trim() === "") {
      errors.push({
        field: "message",
        message: "Message is required",
      });
      this.markFieldInvalid("message", "Message is required");
    } else if (formData.message.length < 10) {
      errors.push({
        field: "message",
        message: "Message must be at least 10 characters",
      });
      this.markFieldInvalid(
        "message",
        "Message must be at least 10 characters",
      );
    } else {
      this.markFieldValid("message");
    }

    // Phone is optional, but validate if provided
    if (formData.phone && formData.phone.trim() !== "") {
      if (!this.isValidPhone(formData.phone)) {
        errors.push({
          field: "phone",
          message: "Please enter a valid phone number",
        });
        this.markFieldInvalid("phone", "Please enter a valid phone number");
      } else {
        this.markFieldValid("phone");
      }
    }

    if (errors.length > 0) {
      this.displayValidationErrors(errors);
      return false;
    }

    return true;
  }

  isValidEmail(email) {
    const emailRegex = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
    return emailRegex.test(email);
  }

  isValidPhone(phone) {
    const phoneRegex =
      /^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.]?[(]?[0-9]{1,4}[)]?[-\s\.]?[0-9]{3,4}[-\s\.]?[0-9]{3,4}$/;
    return phoneRegex.test(phone);
  }

  markFieldInvalid(fieldId, errorMessage) {
    const field = document.getElementById(fieldId);
    if (!field) return;

    field.classList.add("error");

    let errorElement = field.parentElement.querySelector(".field-error");
    if (!errorElement) {
      errorElement = document.createElement("span");
      errorElement.className = "field-error";
      field.parentElement.appendChild(errorElement);
    }
    errorElement.textContent = errorMessage;
  }

  markFieldValid(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) return;

    field.classList.remove("error");

    const errorElement = field.parentElement.querySelector(".field-error");
    if (errorElement) {
      errorElement.remove();
    }
  }

  clearFieldErrors() {
    const fields = this.form.querySelectorAll("input, textarea");
    fields.forEach((field) => {
      field.classList.remove("error");
      const errorElement = field.parentElement.querySelector(".field-error");
      if (errorElement) {
        errorElement.remove();
      }
    });
  }

  displayValidationErrors(errors) {
    if (errors.length > 0) {
      const firstErrorField = document.getElementById(errors[0].field);
      if (firstErrorField) {
        firstErrorField.scrollIntoView({
          behavior: "smooth",
          block: "center",
        });
        firstErrorField.focus();
      }
    }
  }

  async ajaxSubmit() {
    const formData = new FormData(this.form);
    
    // Use WordPress AJAX URL from localized data or fallback
    const ajaxUrl = window.jkjaacData?.ajaxUrl || '/wp-admin/admin-ajax.php';
    
    // Ensure subject is included
    if (!formData.has('subject') || !formData.get('subject')) {
      formData.set('subject', this.getSelectedSubject());
    }

    const response = await fetch(ajaxUrl, {
      method: 'POST',
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();

    if (!result.success) {
      // Handle field-specific errors from server
      if (result.data && result.data.errors) {
        Object.entries(result.data.errors).forEach(([field, message]) => {
          this.markFieldInvalid(field, message);
        });
      }
      throw new Error(result.data?.message || 'Submission failed. Please try again.');
    }

    return result;
  }

  simulateSubmission() {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve();
      }, 500);
    });
  }

  showSuccess() {
    if (this.config.hideWrapOnSuccess && this.wrapElement) {
      this.wrapElement.style.display = "none";
    }

    if (this.successElement) {
      this.successElement.classList.add(this.config.successClass);

      if (this.config.autoHideSuccess) {
        setTimeout(() => {
          this.hideSuccess();
        }, this.config.autoHideDelay);
      }
    }
  }

  hideSuccess() {
    if (this.successElement) {
      this.successElement.classList.remove(this.config.successClass);
    }

    if (this.config.hideWrapOnSuccess && this.wrapElement) {
      this.wrapElement.style.display = "block";
    }
  }

  showError(errorMessage) {
    let errorElement = this.form.querySelector(".form-error");

    if (!errorElement) {
      errorElement = document.createElement("div");
      errorElement.className = "form-error";
      this.form.insertBefore(errorElement, this.form.firstChild);
    }

    errorElement.textContent =
      errorMessage || "An error occurred. Please try again.";
    errorElement.style.display = "block";

    setTimeout(() => {
      if (errorElement) {
        errorElement.style.display = "none";
      }
    }, 5000);
  }

  clearFormError() {
    const errorElement = this.form.querySelector(".form-error");
    if (errorElement) {
      errorElement.style.display = "none";
    }
  }

  resetForm() {
    this.form.reset();
    this.clearFieldErrors();
    
    // Reset subject pills to first option
    const firstPill = document.querySelector('.subject-pill');
    if (firstPill) {
      const pills = document.querySelectorAll('.subject-pill');
      pills.forEach(p => p.classList.remove('active'));
      firstPill.classList.add('active');
      this.updateSubjectInput();
    }
  }

  getFormData() {
    const formData = new FormData(this.form);
    const data = {};

    for (let [key, value] of formData.entries()) {
      data[key] = value;
    }

    // Ensure subject is included
    if (!data.subject) {
      data.subject = this.getSelectedSubject();
    }

    return data;
  }

  disableSubmitButton(disabled) {
    if (this.submitButton) {
      this.submitButton.disabled = disabled;

      if (disabled) {
        const originalText = this.submitButton.innerHTML;
        this.submitButton.setAttribute("data-original-text", originalText);
        this.submitButton.innerHTML = '<span class="submitting-text">Sending...</span>';
      } else {
        const originalText =
          this.submitButton.getAttribute("data-original-text");
        if (originalText) {
          this.submitButton.innerHTML = originalText;
        }
      }
    }
  }

  async submit() {
    if (this.config.validateForm) {
      const isValid = this.validateForm();
      if (!isValid) return false;
    }

    this.handleSubmit(new Event("submit"));
    return true;
  }

  refresh() {
    this.cacheElements();
    this.attachEventListeners();
  }

  destroy() {
    if (this.form) {
      this.form.removeEventListener("submit", this.handleSubmit);
    }

    if (this.wrapElement) {
      this.wrapElement.style.display = "";
    }

    if (this.successElement) {
      this.successElement.classList.remove(this.config.successClass);
    }

    this.form = null;
    this.wrapElement = null;
    this.successElement = null;
    this.submitButton = null;
    this.subjectInput = null;
    this.isInitialized = false;
  }
}

function createContactFormHandler(options = {}) {
  return new ContactFormHandler(options);
}

class NewsletterHandler {
  constructor(options = {}) {
    this.config = {
      formSelector: options.formSelector || ".newsletter-form",
      emailInputSelector: options.emailInputSelector || 'input[type="email"]',
      messageSelector: options.messageSelector || ".newsletter-msg",
      successMessage: options.successMessage || "✓ Subscribed! Thank you.",
      invalidEmailMessage:
        options.invalidEmailMessage || "Please enter a valid email.",
      errorMessage:
        options.errorMessage || "Subscription failed. Please try again.",
      duplicateEmailMessage:
        options.duplicateEmailMessage || "This email is already subscribed.",
      clearInputOnSuccess: options.clearInputOnSuccess !== false,
      useAjax: options.useAjax || false,
      apiEndpoint: options.apiEndpoint || null,
      apiMethod: options.apiMethod || "POST",
      apiHeaders: options.apiHeaders || { "Content-Type": "application/json" },
      onSuccess: options.onSuccess || null,
      onError: options.onError || null,
      debugMode: options.debugMode || false,
      ...options,
    };

    this.forms = [];
    this.activeForms = new Map();

    this.isSubmitting = false;

    this.handleSubmit = this.handleSubmit.bind(this);
    this.validateEmail = this.validateEmail.bind(this);
    this.showMessage = this.showMessage.bind(this);
    this.clearMessage = this.clearMessage.bind(this);

    this.init();
  }

  init() {
    this.cacheForms();

    if (!this.validateElements()) {
      return;
    }

    this.attachEventListeners();
  }

  cacheForms() {
    this.forms = Array.from(
      document.querySelectorAll(this.config.formSelector),
    );
  }

  validateElements() {
    if (this.forms.length === 0) {
      return false;
    }
    return true;
  }

  attachEventListeners() {
    this.forms.forEach((form) => {
      form.removeEventListener("submit", this.handleSubmit);
      form.addEventListener("submit", this.handleSubmit);

      const emailInput = form.querySelector(this.config.emailInputSelector);
      const messageElement = form.querySelector(this.config.messageSelector);

      this.activeForms.set(form, {
        emailInput,
        messageElement,
        isSubmitting: false,
      });
    });
  }

  async handleSubmit(event) {
    event.preventDefault();

    const form = event.currentTarget;
    const formData = this.activeForms.get(form);

    if (!formData) return;

    if (formData.isSubmitting) {
      return;
    }

    const email = formData.emailInput?.value.trim() || "";

    if (!this.validateEmail(email)) {
      this.showMessage(form, this.config.invalidEmailMessage, "error");
      return;
    }

    formData.isSubmitting = true;
    this.disableForm(form, true);

    try {
      if (this.config.useAjax && this.config.apiEndpoint) {
        await this.ajaxSubscribe(email, form);
      } else {
        await this.localSubscribe(email, form);
      }

      this.showMessage(form, this.config.successMessage, "success");

      if (this.config.clearInputOnSuccess && formData.emailInput) {
        formData.emailInput.value = "";
      }

      if (this.config.onSuccess) {
        this.config.onSuccess(email, form);
      }

      this.dispatchEvent("success", { email, form });
    } catch (error) {
      let errorMessage = this.config.errorMessage;
      if (error.message === "duplicate") {
        errorMessage = this.config.duplicateEmailMessage;
      }

      this.showMessage(form, errorMessage, "error");

      if (this.config.onError) {
        this.config.onError(error, email, form);
      }

      this.dispatchEvent("error", { email, form, error });
    } finally {
      formData.isSubmitting = false;
      this.disableForm(form, false);

      if (this.config.autoClearDelay) {
        setTimeout(() => {
          this.clearMessage(form);
        }, this.config.autoClearDelay);
      }
    }
  }

  validateEmail(email) {
    const emailRegex = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
    return emailRegex.test(email);
  }

  async ajaxSubscribe(email, form) {
    const response = await fetch(this.config.apiEndpoint, {
      method: this.config.apiMethod,
      headers: this.config.apiHeaders,
      body: JSON.stringify({
        email: email,
        ...this.getFormData(form),
      }),
    });

    if (!response.ok) {
      if (response.status === 409) {
        throw new Error("duplicate");
      }
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    return result;
  }

  localSubscribe(email, form) {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        if (this.config.checkDuplicatesLocally) {
          const subscribed = localStorage.getItem("newsletter_subscribed");
          if (subscribed === email) {
            reject(new Error("duplicate"));
            return;
          }
          localStorage.setItem("newsletter_subscribed", email);
        }

        resolve();
      }, 500);
    });
  }

  showMessage(form, message, type = "info") {
    const formData = this.activeForms.get(form);
    if (!formData?.messageElement) return;

    const msgElement = formData.messageElement;
    msgElement.textContent = message;
    msgElement.className = `newsletter-msg ${type}`;

    msgElement.setAttribute("role", "status");
    msgElement.setAttribute("aria-live", "polite");
  }

  clearMessage(form) {
    const formData = this.activeForms.get(form);
    if (!formData?.messageElement) return;

    formData.messageElement.textContent = "";
    formData.messageElement.className = "newsletter-msg";
  }
  
  clearAllMessages() {
    this.forms.forEach((form) => {
      this.clearMessage(form);
    });
  }

  disableForm(form, disabled) {
    const inputs = form.querySelectorAll("input, button");
    inputs.forEach((input) => {
      input.disabled = disabled;
    });
  }

  getFormData(form) {
    const formData = new FormData(form);
    const data = {};

    for (let [key, value] of formData.entries()) {
      if (key !== "email") {
        data[key] = value;
      }
    }

    return data;
  }

  async subscribe(email, form = null) {
    if (!this.validateEmail(email)) {
      throw new Error("Invalid email format");
    }

    const targetForm = form || this.forms[0];
    if (!targetForm) {
      throw new Error("No form available");
    }

    const formData = this.activeForms.get(targetForm);
    if (!formData) {
      throw new Error("Form not initialized");
    }

    if (formData.emailInput) {
      formData.emailInput.value = email;
    }

    await this.handleSubmit({
      currentTarget: targetForm,
      preventDefault: () => {},
    });
  }

  getFormStatus(form) {
    const formData = this.activeForms.get(form);
    if (!formData) return null;

    return {
      isSubmitting: formData.isSubmitting,
      hasEmail: formData.emailInput?.value?.trim() !== "",
      isValidEmail: this.validateEmail(
        formData.emailInput?.value?.trim() || "",
      ),
    };
  }

  addForm(formElement) {
    if (!(formElement instanceof Element)) {
      return false;
    }

    this.forms.push(formElement);

    const emailInput = formElement.querySelector(
      this.config.emailInputSelector,
    );
    const messageElement = formElement.querySelector(
      this.config.messageSelector,
    );

    this.activeForms.set(formElement, {
      emailInput,
      messageElement,
      isSubmitting: false,
    });

    formElement.addEventListener("submit", this.handleSubmit);

    return true;
  }

  removeForm(formElement) {
    const index = this.forms.indexOf(formElement);
    if (index !== -1) {
      this.forms.splice(index, 1);
      this.activeForms.delete(formElement);
      formElement.removeEventListener("submit", this.handleSubmit);
      return true;
    }
    return false;
  }

  updateConfig(newConfig) {
    Object.assign(this.config, newConfig);
  }

  setCustomValidation(validatorFn) {
    if (typeof validatorFn === "function") {
      this.customValidator = validatorFn;
    }
  }

  dispatchEvent(eventType, detail) {
    const event = new CustomEvent("newsletterEvent", {
      detail: {
        type: eventType,
        timestamp: new Date(),
        ...detail,
      },
    });
    document.dispatchEvent(event);
  }

  destroy() {
    this.forms.forEach((form) => {
      form.removeEventListener("submit", this.handleSubmit);
      this.disableForm(form, false);
    });

    this.activeForms.clear();
    this.forms = [];
  }
}

function createNewsletterHandler(options = {}) {
  return new NewsletterHandler(options);
}

window.kfmNewsletter = function (form) {
  if (window.newsletterHandler) {
    const event = new Event("submit");
    event.currentTarget = form;
    window.newsletterHandler.handleSubmit(event);
  } else {
    var input = form.querySelector('input[type="email"]');
    var msg = form.querySelector(".newsletter-msg");
    var email = input.value.trim();

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      msg.textContent = "Please enter a valid email.";
      msg.className = "newsletter-msg error";
      return false;
    }

    msg.textContent = "✓ Subscribed! Thank you.";
    msg.className = "newsletter-msg";
    input.value = "";
    return false;
  }
};

class Gallery {
  constructor(options = {}) {
    this.config = {
      galleryId: options.galleryId || "galleryGrid",
      filterPillSelector: options.filterPillSelector || ".filter-pill",
      colBtnSelector: options.colBtnSelector || ".col-btn",
      itemSelector: options.itemSelector || ".pin-card",
      lightboxId: options.lightboxId || "lightbox",
      enableIntersectionObserver: options.enableIntersectionObserver !== false,
      ...options,
    };

    this.galleryGrid = document.getElementById(this.config.galleryId);
    this.filterPills = document.querySelectorAll(
      this.config.filterPillSelector,
    );
    this.colBtns = document.querySelectorAll(this.config.colBtnSelector);
    this.lightbox = document.getElementById(this.config.lightboxId);

    this.items = [];
    this.currentFilter = "all";
    this.currentCols = "4";
    this.currentIndex = 0;
    this.intersectionObserver = null;

    this.lbElements = {
      imgWrap: null,
      cat: null,
      title: null,
      loc: null,
      desc: null,
      counter: null,
      close: null,
      prev: null,
      next: null,
    };

    this.countEl = document.getElementById("galleryCount");
    this.emptyEl = document.getElementById("galleryEmpty");

    this.init();
  }

  init() {
    if (!this.galleryGrid) {
      console.warn("Gallery: No gallery grid found");
      return;
    }

    this.loadItems();
    this.initIntersectionObserver();
    this.initFilters();
    this.initColumnButtons();
    this.initLightbox();
    this.updateGalleryCount();
  }

  loadItems() {
    this.items = Array.from(
      this.galleryGrid.querySelectorAll(this.config.itemSelector),
    );
  }

  refreshItems() {
    this.loadItems();
    this.updateGalleryCount();
    this.reobserveItems();
  }

  initIntersectionObserver() {
    if (!this.config.enableIntersectionObserver) return;

    this.intersectionObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry, index) => {
          if (entry.isIntersecting) {
            setTimeout(() => {
              entry.target.classList.add("in");
            }, index * 30);
            this.intersectionObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.02, rootMargin: "0px 0px -10px 0px" },
    );

    this.items.forEach((item) => {
      this.intersectionObserver.observe(item);
    });
  }

  reobserveItems() {
    if (!this.intersectionObserver) return;

    this.items.forEach((item) => {
      if (!item.classList.contains("in")) {
        this.intersectionObserver.observe(item);
      }
    });
  }

  initFilters() {
    if (!this.filterPills.length) return;

    this.filterPills.forEach((pill) => {
      pill.addEventListener("click", (e) => {
        const filter = pill.dataset.filter;
        if (!filter) return;

        this.setActiveFilter(pill, filter);
        this.applyFilter(filter);
        this.updateGalleryCount();
      });
    });
  }

  setActiveFilter(activePill, filter) {
    this.filterPills.forEach((p) => p.classList.remove("active"));
    activePill.classList.add("active");
    this.currentFilter = filter;
  }

  applyFilter(filter) {
    let visibleCount = 0;

    this.items.forEach((item) => {
      const cats = item.dataset.cat || "";
      const show = filter === "all" || cats.split(" ").includes(filter);
      item.style.display = show ? "" : "none";
      if (show) visibleCount++;
    });

    return visibleCount;
  }

  updateGalleryCount() {
    const visibleCount = this.getVisibleItems().length;

    if (this.countEl) {
      this.filterPills.forEach((pill) => {
        const filter = pill.dataset.filter;
        if (filter === "all") {
          pill.textContent = `All (${this.items.length})`;
        } else {
          const count = this.items.filter((item) => {
            const cats = item.dataset.cat || "";
            return cats.split(" ").includes(filter);
          }).length;
          const baseText = pill.textContent.split("(")[0].trim();
          pill.textContent = `${baseText} (${count})`;
        }
      });

      this.countEl.textContent = `${visibleCount} photo${visibleCount !== 1 ? "s" : ""}`;
    }

    if (this.emptyEl) {
      this.emptyEl.classList.toggle("show", visibleCount === 0);
    }
  }

  getVisibleItems() {
    return this.items.filter((item) => item.style.display !== "none");
  }

  initColumnButtons() {
    if (!this.colBtns.length) return;

    this.colBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        const cols = btn.dataset.cols;
        if (!cols) return;

        this.setActiveColumnButton(btn);
        this.setColumnLayout(cols);
      });
    });
  }

  setActiveColumnButton(activeBtn) {
    this.colBtns.forEach((b) => b.classList.remove("active"));
    activeBtn.classList.add("active");
    this.currentCols = activeBtn.dataset.cols;
  }

  setColumnLayout(cols) {
    this.galleryGrid.classList.remove("cols-2", "cols-3", "cols-4", "cols-5");

    if (cols !== "4") {
      this.galleryGrid.classList.add(`cols-${cols}`);
    }

    this.galleryGrid.style.display = "none";
    this.galleryGrid.offsetHeight;
    this.galleryGrid.style.display = "";
  }

  initLightbox() {
    if (!this.lightbox) return;
    this.lbElements = {
      imgWrap: document.getElementById("lbImgWrap"),
      cat: document.getElementById("lbCat"),
      title: document.getElementById("lbTitle"),
      loc: document.getElementById("lbLoc"),
      desc: document.getElementById("lbDesc"),
      counter: document.getElementById("lbCounter"),
      close: document.getElementById("lbClose"),
      prev: document.getElementById("lbPrev"),
      next: document.getElementById("lbNext"),
    };
    this.items.forEach((item) => {
      item.addEventListener("click", (e) => {
        if (e.target.closest(".pin-zoom")) return;

        const visibleItems = this.getVisibleItems();
        const index = visibleItems.indexOf(item);
        if (index !== -1) {
          this.openLightbox(index);
        }
      });
    });

    if (this.lbElements.close) {
      this.lbElements.close.addEventListener("click", () =>
        this.closeLightbox(),
      );
    }

    if (this.lbElements.prev) {
      this.lbElements.prev.addEventListener("click", () =>
        this.navigateLightbox(-1),
      );
    }

    if (this.lbElements.next) {
      this.lbElements.next.addEventListener("click", () =>
        this.navigateLightbox(1),
      );
    }

    this.lightbox.addEventListener("click", (e) => {
      if (e.target === this.lightbox || e.target.closest(".lb-close")) {
        this.closeLightbox();
      }
    });

    document.addEventListener("keydown", (e) => {
      if (!this.lightbox.classList.contains("open")) return;

      switch (e.key) {
        case "Escape":
          this.closeLightbox();
          break;
        case "ArrowLeft":
          this.navigateLightbox(-1);
          break;
        case "ArrowRight":
          this.navigateLightbox(1);
          break;
      }
    });
  }

  openLightbox(index) {
    const visibleItems = this.getVisibleItems();
    const item = visibleItems[index];

    if (!item) return;

    this.currentIndex = index;

    const imgWrap = item.querySelector(".pin-img-wrap");
    const img = item.querySelector("img");

    const title =
      item.dataset.title ||
      item.querySelector(".pin-footer-title")?.textContent ||
      "";
    const location =
      item.dataset.loc ||
      item.querySelector(".pin-footer-loc")?.textContent ||
      "";
    const description = item.dataset.desc || "";

    let category = item.dataset.cat || "";
    const tagElement = item.querySelector(".pin-tag");
    if (tagElement && !category) {
      category = tagElement.textContent;
    }

    const categoryLabel = category
      .split(" ")
      .map((c) => c.charAt(0).toUpperCase() + c.slice(1))
      .join(" · ");

    if (this.lbElements.imgWrap) {
      if (img && img.src) {
        this.lbElements.imgWrap.innerHTML = `
                    <img src="${img.src}" alt="${img.alt || title}" style="width:100%;height:100%;object-fit:contain;display:block;">
                `;
      } else {
        this.lbElements.imgWrap.innerHTML = `
                    <div class="lb-placeholder" style="background:var(--g800);display:flex;align-items:center;justify-content:center;height:100%;flex-direction:column;">
                        <i class="ri-image-line" style="font-size:5rem;color:var(--g400);"></i>
                        <p style="margin-top:1rem;">Image Coming Soon</p>
                    </div>
                `;
      }
    }

    if (this.lbElements.cat) this.lbElements.cat.textContent = categoryLabel;
    if (this.lbElements.title) this.lbElements.title.textContent = title;
    if (this.lbElements.loc) this.lbElements.loc.textContent = location;
    if (this.lbElements.desc) this.lbElements.desc.textContent = description;

    if (this.lbElements.counter) {
      this.lbElements.counter.innerHTML = `<span>${index + 1}</span> / ${visibleItems.length}`;
    }

    this.lightbox.classList.add("open");
    document.body.style.overflow = "hidden";
  }

  closeLightbox() {
    this.lightbox.classList.remove("open");
    document.body.style.overflow = "";
  }

  navigateLightbox(direction) {
    const visibleItems = this.getVisibleItems();
    if (visibleItems.length === 0) return;

    this.currentIndex =
      (this.currentIndex + direction + visibleItems.length) %
      visibleItems.length;
    this.openLightbox(this.currentIndex);
  }

  destroy() {
    if (this.intersectionObserver) {
      this.intersectionObserver.disconnect();
    }

    this.items = [];
    this.galleryGrid = null;
    this.filterPills = null;
    this.colBtns = null;
    this.lightbox = null;
    this.lbElements = {};
  }
}

class GalleryManager {
  constructor() {
    this.galleries = [];
  }

  createGallery(options = {}) {
    const gallery = new Gallery(options);
    this.galleries.push(gallery);
    return gallery;
  }

  destroyAll() {
    this.galleries.forEach((gallery) => gallery.destroy());
    this.galleries = [];
  }

  refreshAll() {
    this.galleries.forEach((gallery) => gallery.refreshItems());
  }

  getGallery(id) {
    return this.galleries.find((g) => g.config.galleryId === id);
  }
}

class DemandFilter {
  constructor(options = {}) {
    this.config = {
      containerId: options.containerId || "demands-container",
      filterButtonsSelector: options.filterButtonsSelector || ".filter-btn",
      itemsSelector: options.itemsSelector || ".demand-item",
      activeClass: options.activeClass || "active",
      statusDoneClass: options.statusDoneClass || ".status-done",
      statusPendingClass:
        options.statusPendingClass || ".status-pending, .status-partial",
      defaultDisplay: options.defaultDisplay || "flex",
      hiddenDisplay: options.hiddenDisplay || "none",
      dataCategoryAttribute: options.dataCategoryAttribute || "cat",
      debugMode: options.debugMode || false,
      onFilter: options.onFilter || null,
      ...options,
    };

    this.filterButtons = null;
    this.filterItems = null;
    this.container = null;

    this.currentFilter = "all";
    this.isInitialized = false;

    this.handleFilterClick = this.handleFilterClick.bind(this);
    this.filter = this.filter.bind(this);
    this.updateUI = this.updateUI.bind(this);
    this.refreshFilter = this.refreshFilter.bind(this);

    this.init();
  }

  init() {
    if (this.isInitialized) {
      return;
    }

    this.cacheElements();

    if (!this.validateElements()) {
      return;
    }

    this.attachEventListeners();
    this.setInitialActiveButton();
    this.isInitialized = true;
  }

  cacheElements() {
    this.container = document.getElementById(this.config.containerId);
    this.filterButtons = document.querySelectorAll(
      this.config.filterButtonsSelector,
    );
    this.filterItems = document.querySelectorAll(this.config.itemsSelector);
  }

  validateElements() {
    if (!this.container) {
      
      return false;
    }

    if (this.filterButtons.length === 0) {
     
      return false;
    }

    if (this.filterItems.length === 0) {
      console.warn(
        `DemandFilter: No items found with selector "${this.config.itemsSelector}"`,
      );
    }

    return true;
  }

  attachEventListeners() {
    this.filterButtons.forEach((button) => {
      button.removeEventListener("click", this.handleFilterClick);
      button.addEventListener("click", this.handleFilterClick);
    });
  }

  handleFilterClick(event) {
    const button = event.currentTarget;
    const category = this.getCategoryFromButton(button);
    this.filter(category, button);
  }

  getCategoryFromButton(button) {
    // Priority: data-filter attribute
    const dataFilter = button.getAttribute("data-filter");
    if (dataFilter) return dataFilter;

    // Fallback: text content
    const text = button.textContent.trim().toLowerCase();
    if (text.includes("structural")) return "structural";
    if (text.includes("economic")) return "economic";
    if (text.includes("social")) return "social";
    if (text.includes("implemented") || text.includes("✓")) return "done";
    if (text.includes("pending")) return "pending";
    if (text.includes("all")) return "all";

    return "all";
  }

  filter(category, activeButton = null) {
    this.currentFilter = category;

    this.updateActiveButton(activeButton);

    const items = this.getFilterItems();

    items.forEach((item) => {
      const shouldShow = this.shouldShowItem(item, category);
      this.setItemVisibility(item, shouldShow);
    });

    const visibleCount = Array.from(items).filter(
      (item) => item.style.display !== this.config.hiddenDisplay,
    ).length;

    if (this.config.onFilter && typeof this.config.onFilter === "function") {
      this.config.onFilter(category, items, visibleCount);
    }

    this.dispatchFilterEvent(category, visibleCount);
  }

  updateActiveButton(activeButton) {
    const buttons = this.getFilterButtons();

    buttons.forEach((button) => {
      button.classList.remove(this.config.activeClass);
    });

    if (activeButton) {
      activeButton.classList.add(this.config.activeClass);
    } else {
      const buttonToActivate = this.findButtonByCategory(this.currentFilter);
      if (buttonToActivate) {
        buttonToActivate.classList.add(this.config.activeClass);
      }
    }
  }

  findButtonByCategory(category) {
    const buttons = this.getFilterButtons();
    return Array.from(buttons).find(
      (button) => this.getCategoryFromButton(button) === category,
    );
  }

  shouldShowItem(item, category) {
    if (category === "all") {
      return true;
    }

    if (category === "done") {
      return this.isItemDone(item);
    }

    if (category === "pending") {
      return this.isItemPending(item);
    }

    return this.hasMatchingDataCategory(item, category);
  }

  isItemDone(item) {
    return !!item.querySelector(this.config.statusDoneClass);
  }

  isItemPending(item) {
    return !!item.querySelector(this.config.statusPendingClass);
  }

  hasMatchingDataCategory(item, category) {
    const itemCategory = item.dataset[this.config.dataCategoryAttribute];
    return itemCategory === category;
  }

  setItemVisibility(item, shouldShow) {
    item.style.display = shouldShow
      ? this.config.defaultDisplay
      : this.config.hiddenDisplay;
    if (shouldShow) {
      item.classList.remove("filter-hidden");
      item.classList.add("filter-visible");
    } else {
      item.classList.remove("filter-visible");
      item.classList.add("filter-hidden");
    }
  }

  getFilterButtons() {
    return document.querySelectorAll(this.config.filterButtonsSelector);
  }

  getFilterItems() {
    return document.querySelectorAll(this.config.itemsSelector);
  }

  setInitialActiveButton() {
    const activeButton = Array.from(this.filterButtons).find((button) =>
      button.classList.contains(this.config.activeClass),
    );

    if (activeButton) {
      const category = this.getCategoryFromButton(activeButton);
      this.filter(category, activeButton);
    } else if (this.filterButtons.length > 0) {
      const firstButton = this.filterButtons[0];
      firstButton.classList.add(this.config.activeClass);
      const category = this.getCategoryFromButton(firstButton);
      this.filter(category, firstButton);
    }
  }

  refreshFilter() {
    const activeButton = this.getActiveButton();
    if (activeButton) {
      const category = this.getCategoryFromButton(activeButton);
      this.filter(category, activeButton);
    } else if (this.currentFilter) {
      this.filter(this.currentFilter);
    }
  }

  getActiveButton() {
    const buttons = this.getFilterButtons();
    return Array.from(buttons).find((button) =>
      button.classList.contains(this.config.activeClass),
    );
  }

  updateUI() {
    this.cacheElements();
    this.attachEventListeners();
    this.refreshFilter();
  }

  addDemandItem(itemHTML) {
    if (!this.container) return;

    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = itemHTML;
    const newItem = tempDiv.firstElementChild;

    if (newItem && newItem.classList.contains("demand-item")) {
      this.container.appendChild(newItem);
      this.updateUI();
      return newItem;
    }

    return null;
  }

  removeDemandItemsByFilter(callback) {
    const items = this.getFilterItems();
    items.forEach((item) => {
      if (callback(item)) {
        item.remove();
      }
    });
    this.updateUI();
  }

  dispatchFilterEvent(category, visibleCount) {
    const event = new CustomEvent("demandFilterChanged", {
      detail: {
        category: category,
        visibleCount: visibleCount,
        totalItems: this.getFilterItems().length,
        timestamp: new Date(),
      },
    });
    document.dispatchEvent(event);
  }

  getCurrentFilter() {
    return this.currentFilter;
  }

  getVisibleCount() {
    const items = this.getFilterItems();
    return Array.from(items).filter(
      (item) => item.style.display !== this.config.hiddenDisplay,
    ).length;
  }

  reset() {
    const allButton = this.findButtonByCategory("all");
    if (allButton) {
      this.filter("all", allButton);
    }
  }

  destroy() {
    this.filterButtons.forEach((button) => {
      button.removeEventListener("click", this.handleFilterClick);
    });

    const items = this.getFilterItems();
    items.forEach((item) => {
      item.style.display = this.config.defaultDisplay;
      item.classList.remove("filter-hidden", "filter-visible");
    });

    this.filterButtons = null;
    this.filterItems = null;
    this.container = null;
    this.isInitialized = false;
  }
}

class BackToTop {
  constructor({
    selector = ".back-to-top",
    scrollThreshold = 500,
    throttleDelay = 100,
  } = {}) {
    this.settings = {
      selector,
      scrollThreshold,
      throttleDelay,
    };

    this.$backToTop = null;
    this.throttledToggleVisibility = null;

    this.init();
  }

  init() {
    const { selector, throttleDelay } = this.settings;

    this.$backToTop = document.querySelector(selector);

    if (!this.$backToTop) return;

    this.throttledToggleVisibility = this.throttle(
      this.toggleVisibility.bind(this),
      throttleDelay,
    );

    window.addEventListener("scroll", this.throttledToggleVisibility);
    this.$backToTop.addEventListener("click", this.scrollToTop.bind(this));

    this.toggleVisibility();
  }

  throttle(func, wait) {
    let timeout;
    return (...args) => {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), wait);
    };
  }

  toggleVisibility() {
    const { scrollThreshold } = this.settings;

    if (window.scrollY > scrollThreshold) {
      this.$backToTop.classList.add("active");
    } else {
      this.$backToTop.classList.remove("active");
    }
  }

  scrollToTop(e) {
    if (e) e.preventDefault();

    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  }

  destroy() {
    window.removeEventListener("scroll", this.throttledToggleVisibility);
    this.$backToTop.removeEventListener("click", this.scrollToTop);
  }
}

// Helper function for updateContentByCategory
function updateContentByCategory(category) {
}

// DOMContentLoaded event handler
document.addEventListener("DOMContentLoaded", function() {
  const navigation = new NavigationManager();

  const scrollReveal = new ScrollRevealManager();

  const progressBars = new AdvancedProgressBarManager({
    threshold: 0.3,
    animationDelay: 100,
    staggerDelay: 50,
    animationEasing: "cubic-bezier(0.4, 0, 0.2, 1)",
    animationDuration: "0.8s",
    resetOnExit: false,
    once: true,
    debug: true,
  });

  const faq = new FAQAccordion();

  if (document.querySelector(".demand-filter")) {
    const demandFilter = new DemandFilter({
      containerId: "demands-container",
      filterButtonsSelector: ".filter-btn",
      itemsSelector: ".demand-item",
      activeClass: "active",
      debugMode: false,
      onFilter: (category, items, visibleCount) => {
        const totalCount = items.length;
        const filterButton = document.querySelector(
          `.filter-btn[data-filter="${category}"]`,
        );
        if (filterButton) {
          const originalText = filterButton.textContent.split("(")[0].trim();
          if (category === "all") {
            filterButton.textContent = `${originalText} (${visibleCount} Demands)`;
          } else if (visibleCount > 0) {
            filterButton.textContent = `${originalText} (${visibleCount})`;
          } else {
            filterButton.textContent = originalText;
          }
        }
      },
    });

    window.demandFilter = demandFilter;
  }

  // Subject Pill Navigation with Contact Form integration
  const pills = document.querySelectorAll(".subject-pill");
  if (pills.length) {
    const subjectPillNav = new SubjectPillNavigation({
      pillsSelector: ".subject-pill",
      activeClass: "active",
      allowMultiple: false,
      persistState: false,
      debugMode: false,
      onPillChange: (activePill, clickedPill) => {
        // Update hidden subject input in contact form
        const subjectInput = document.getElementById('contactSubject');
        if (subjectInput && activePill) {
          subjectInput.value = activePill.textContent.trim();
        }
        
        // Also update if using data-value attribute
        if (subjectInput && activePill) {
          const dataValue = activePill.getAttribute('data-value');
          if (dataValue) {
            subjectInput.value = dataValue;
          }
        }
        
        const category = activePill?.getAttribute('data-category') || 
                       activePill?.textContent.toLowerCase();
        updateContentByCategory(category);
      },
    });

    window.subjectPillNav = subjectPillNav;
  }

  // Contact Form Handler
  const contactForm = document.getElementById("contactForm");
  if (contactForm) {
    const formHandler = new ContactFormHandler({
      formId: "contactForm",
      wrapElementId: "formWrap",
      successElementId: "formSuccess",
      successClass: "show",
      hideWrapOnSuccess: true,
      validateForm: true,
      useAjax: true,
      resetOnSuccess: false,
      autoHideSuccess: false,
      debugMode: false,
      onSuccess: (formData, result) => {
        // Google Analytics tracking if available
        if (typeof gtag !== "undefined") {
          gtag("event", "form_submission", {
            event_category: "contact",
            event_label: "Contact Form",
          });
        }
        
        // Facebook Pixel tracking if available
        if (typeof fbq !== "undefined") {
          fbq("track", "Contact");
        }
        
      },
      onError: (error, formData) => {
        if (typeof gtag !== "undefined") {
          gtag("event", "form_error", {
            event_category: "contact",
            event_label: error.message,
          });
        }
      },
      onValidationError: (formData) => {
      },
    });

    window.contactFormHandler = formHandler;
  }

  // Gallery initialization
  if (document.getElementById("galleryGrid")) {
    window.gallery = new Gallery({
      galleryId: "galleryGrid",
      filterPillSelector: ".filter-pill",
      colBtnSelector: ".col-btn",
      itemSelector: ".pin-card",
      lightboxId: "lightbox",
      enableIntersectionObserver: true,
    });

    window.galleryManager = new GalleryManager();
    window.galleryManager.galleries.push(window.gallery);
  }

  // Newsletter Handler
  const newsletterForms = document.querySelectorAll(".newsletter-form");
  if (newsletterForms.length) {
    const newsletterHandler = new NewsletterHandler({
      formSelector: ".newsletter-form",
      emailInputSelector: 'input[type="email"]',
      messageSelector: ".newsletter-msg",
      successMessage: "✓ Subscribed! Thank you.",
      invalidEmailMessage: "Please enter a valid email.",
      errorMessage: "Subscription failed. Please try again.",
      duplicateEmailMessage: "This email is already subscribed.",
      clearInputOnSuccess: true,
      useAjax: false,
      autoClearDelay: 5000,
      debugMode: false,
      onSuccess: (email, form) => {
        if (typeof gtag !== "undefined") {
          gtag("event", "newsletter_subscription", {
            event_category: "engagement",
            event_label: "Newsletter Signup",
          });
        }
      },
      onError: (error, email, form) => {

        if (typeof gtag !== "undefined") {
          gtag("event", "newsletter_error", {
            event_category: "engagement",
            event_label: error.message,
          });
        }
      },
    });

    window.newsletterHandler = newsletterHandler;
  }

  // FAQ Tabs
  if (document.querySelector(".faq-tab")) {
    const faqTabs = new FAQTabController();
    window.faqTabs = faqTabs;
  }
  
  const backToTop = new BackToTop();
});