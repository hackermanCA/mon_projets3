const express = require('express');
const app = express();
const port = 4000; // Changement du port 3000 → 4000

// Middleware pour servir les fichiers statiques (HTML, CSS, JS)
app.use(express.static('public'));

// Route principale
app.get('/', (req, res) => {
    res.send('Serveur fonctionne bien sur le port 4000 !');
});

// Route pour rediriger vers WhatsApp
app.get('/contact-whatsapp', (req, res) => {
    const whatsappNumber = '243976443487'; // Mets ton numéro en format international
    const whatsappLink = `https://wa.me/${whatsappNumber}`;
    res.redirect(whatsappLink);
});

// Démarrer le serveur
app.listen(port, () => {
    console.log(`✅ Serveur lancé sur http://localhost:${port}`);
});

