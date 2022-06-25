
const fs = require("fs");
const args = process.argv.slice(2);
const inputFolder = args[0];
const dir = `${__dirname}/output/metadata/`
const inputFiles = fs.readdirSync(dir).sort();

inputFiles.forEach((file) => {
  let id = file.split(".").shift();
  let data = JSON.parse(fs.readFileSync(`${dir}/${file}`));

  data.image = `https://piptle.mypinata.cloud/ipfs/etdffdfgdfgfg/${id}.png`;

  fs.writeFileSync(`${dir}/${file}` , JSON.stringify(data, null, 2));
  console.log(data.image);

});
          



