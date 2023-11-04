var textStrings = {
    es: {
        routes: "Rutas",
        home: "Inicio",
        profile: "Perfil",
        routes: "Rutas",
        logout: "Cerrar sesión",
        changeLanguage: "Change language",
        trunkRoutes: "Rutas troncales",
        deliveries: "Entregas",
        collection: "Recolección",
        client: "Cliente",
        status: "Estado",
        date: "Fecha",
        notStarted: "sin empezar",
        inProcess: "en proceso",
        finished: "finalizado",
        deliveries: "Entregas",
        home: "Inicio",
        profile: "Perfil",
        routes: "Rutas",
        logout: "Cerrar sesión",
        changeLanguage: "Change language",
        packagesToDeliver: "Paquetes a entregar",
        address: "Domicilio",
        packages: "Paquete/s",
        deliverPackage: "Entregar paquete",
        startDeliveries: "Comenzar entregas",
        finishDelivery: "Finalizar entrega",
        noAssignDeliveries: "No hay entregas asignadas",
        errorTooManyDeliveries: "Error, demasiadas entregas asignadas"
    },
    en: {
        routes: "Routes",
        home: "Home",
        profile: "Profile",
        routes: "Routes",
        logout: "Log out",
        changeLanguage: "Cambiar idioma",
        trunkRoutes: "Trunk Routes",
        deliveries: "Deliveries",
        collection: "Collection",
        client: "Client",
        status: "Status",
        date: "Date",
        notStarted: "not started",
        inProcess: "in process",
        finished: "finished",
        deliveries: "Deliveries",
        home: "Home",
        profile: "Profile",
        routes: "Routes",
        logout: "Log out",
        changeLanguage: "Cambiar idioma",
        packagesToDeliver: "Packages to deliver",
        address: "Address",
        packages: "Package/s",
        deliverPackage: "Deliver package",
        startDeliveries: "Start deliveries",
        finishDelivery: "Finish delivery",
        noAssignDeliveries: "No deliveries assigned",
        errorTooManyDeliveries: "Error, too many deliveries assigned"
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


