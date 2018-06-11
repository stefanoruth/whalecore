let app = require('express')();
let cors = require('cors');
var redis = require('redis');
var client = redis.createClient();

app.use(cors());

// Routes
app.get('/', function(req, res) {
    res.send(`
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
        <div class="h-screen flex justify-center items-center bg-blue font-sans">
            <div class="text-5xl text-white">Whalecore API</div>
        </div>
    `);
});

app.get('/content/:slug/:lang', function (req, res) {
    let baseKey = 'whalecore:content.';
    let apiKey = req.query.api_key;
    let dataKey = baseKey+apiKey+'.'+req.params.slug+'.'+req.params.lang;

    if (typeof apiKey === 'undefined') {
        return res.status(403).send('Unauthorized');
    }

    client.get(dataKey, function(error, response){
        if (response) {
            res.status(200).json(JSON.parse(response));
        } else {
            res.status(404).send('Page not found');
        }
    });
});

app.listen(3000);
