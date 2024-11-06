document.addEventListener("DOMContentLoaded", function() {
    const anonymousRadio = document.getElementById("anonymous");
    const nonAnonymousRadio = document.getElementById("nonAnonymous");
    const personalInfoFields = document.getElementById("personalInfo");

    anonymousRadio.addEventListener("change", togglePersonalInfo);
    nonAnonymousRadio.addEventListener("change", togglePersonalInfo);

    function togglePersonalInfo() {
        if (nonAnonymousRadio.checked) {
            personalInfoFields.style.display = "block";
        } else {
            personalInfoFields.style.display = "none";
        }
    }
});
