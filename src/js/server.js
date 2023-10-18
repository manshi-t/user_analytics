const express = require("express");
const bodyParser = require("body-parser");
const app = express();

// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: false }));

// parse application/json
app.use(bodyParser.json());

app.post("/analytics", (req, res) => {
  
    console.log(req.body);
    res.sendStatus(204);
});

app.listen(8000, () => console.log("Listening on 8000"))