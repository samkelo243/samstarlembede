document.querySelector('.menu-toggle').addEventListener('click', () => {
  document.querySelector('.nav-links').classList.toggle('active');
});

 // JavaScript to toggle the button text
    document.addEventListener('DOMContentLoaded', function () {
        const collapseElement = document.getElementById('moreProjects');
        const button = document.getElementById('viewAllBtn');

        if (collapseElement && button) {
            // Event listener for when the projects are shown
            collapseElement.addEventListener('show.bs.collapse', function () {
                // CHANGED: Use "View Less Projects" as requested
                button.innerHTML = 'View Less Projects <i class="fas fa-chevron-up ms-2"></i>';
            });

            // Event listener for when the projects are hidden
            collapseElement.addEventListener('hide.bs.collapse', function () {
                button.innerHTML = 'View All Projects <i class="fas fa-chevron-down ms-2"></i>';
            });
            
            // Set initial button icon
            button.innerHTML = 'View All Projects <i class="fas fa-chevron-down ms-2"></i>';
        }
    });