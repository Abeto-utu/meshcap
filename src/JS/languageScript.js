var textStrings = {
    es: {
        // ... Todas las traducciones en español
    },
    en: {
        // ... Todas las traducciones en inglés
    }
};

function changeLanguage() {
    var htmlTag = document.getElementById('htmlTag');
    var language = htmlTag.getAttribute('lang');
    if (language === 'en') {
        htmlTag.setAttribute('lang', 'es');
        updateText('es');
    } else {
        htmlTag.setAttribute('lang', 'en');
        updateText('en');
    }
}

function updateText(language) {
    var elements = document.querySelectorAll('[data-i18n]');
    elements.forEach(function (element) {
        var key = element.getAttribute('data-i18n');
        if (textStrings[language][key]) {
            element.innerText = textStrings[language][key];
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    updateText('es'); // Establece el idioma predeterminado aquí
});
