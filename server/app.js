
// app.js
// import modules
const express = require('express')
const { nextTick } = require('process')
const app = express()
const port = 3000
app.set('views', './views') // 可以看成設定 Express 一些設定的東西，那這段就是要設定 EJS 的資料夾位子在哪裡，簡單來講就是跟 Express 說我樣板放在哪裡
app.set('view engine', 'ejs') // 告訴 Express 要用哪一個引擎去 Run

// route setting
app.get('/', (req, res) => {
  res.render('index.js');
})

// create server
app.listen(port, () => {
  console.log(`server listen to http://localhost:${port}`)
})
