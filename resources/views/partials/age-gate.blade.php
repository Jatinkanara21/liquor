<div id="age-gate" class="hidden">
    <div class="age-gate-content">
        <h2>Are you over 21?</h2>
        <p>You must be of legal drinking age to enter this site.</p>
        <div class="age-gate-buttons">
            <button id="btn-yes" class="btn btn-primary">Yes, I am over 21</button>
            <button id="btn-no" class="btn btn-outline">No, I am under 21</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ageGate = document.getElementById('age-gate');
        const btnYes = document.getElementById('btn-yes');
        const btnNo = document.getElementById('btn-no');

        if (!localStorage.getItem('age_verified')) {
            ageGate.classList.remove('hidden');
        } else {
            // Check if expired? (Simplification: just check existence)
        }

        btnYes.addEventListener('click', () => {
            localStorage.setItem('age_verified', 'true');
            ageGate.classList.add('hidden');
        });

        btnNo.addEventListener('click', () => {
            alert('You must be over 21 to view this site.');
            window.location.href = 'https://google.com';
        });
    });
</script>
