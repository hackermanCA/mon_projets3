const express = require('express');
const app = express();
const port = 3000;

// Middleware pour servir les fichiers statiques (votre frontend)
app.use(express.static('public'));

// Exemple de route API
app.get('/api/hello', (req, res) => {
  res.json({ message: 'Hello from the backend!' });
});

// Nouvelle route pour rediriger vers WhatsApp
app.get('/contact-whatsapp', (req, res) => {
    const whatsappNumber = '243976443487'; // Numéro au format international
    const whatsappLink = `https://wa.me/${whatsappNumber}`;
    res.redirect(whatsappLink);
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});