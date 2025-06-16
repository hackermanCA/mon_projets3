const express = require('express');
const app = express();
const port = 4000;

// Servir les fichiers du dossier "public"
app.use(express.static('public'));

// Route d'accueil
app.get('/', (req, res) => {
    res.send('✅ Serveur fonctionne bien sur le port 4000 !');
});

// Redirection WhatsApp
app.get('/contact-whatsapp', (req, res) => {
    const whatsappNumber = '243976443487';
    const whatsappLink = `https://wa.me/${whatsappNumber}`;
    res.redirect(whatsappLink);
});

// Démarrage du serveur
app.listen(port, '0.0.0.0', () => {
    console.log(`✅ Serveur lancé sur http://0.0.0.0:${port}`);
});
