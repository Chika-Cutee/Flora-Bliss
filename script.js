// Sticky Header dengan Shadow Effect
window.addEventListener('scroll', function() {
    const header = document.getElementById('header');
    
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Smooth Scrolling untuk Navigation Links
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        const targetSection = document.querySelector(targetId);
        
        if (targetSection) {
            const offsetTop = targetSection.offsetTop - 80;
            
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

// Button Click Event untuk Home Section
document.querySelector('.btn').addEventListener('click', function() {
    const productSection = document.querySelector('#product');
    const offsetTop = productSection.offsetTop - 80;
    
    window.scrollTo({
        top: offsetTop,
        behavior: 'smooth'
    });
});

// Simple Animation saat halaman dimuat
window.addEventListener('load', function() {
    const homeContent = document.querySelector('.home-content');
    homeContent.style.opacity = '0';
    homeContent.style.transform = 'translateY(30px)';
    
    setTimeout(function() {
        homeContent.style.transition = 'all 1s ease';
        homeContent.style.opacity = '1';
        homeContent.style.transform = 'translateY(0)';
    }, 100);
});