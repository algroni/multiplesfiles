//imports needed for this function

const axios = require('axios');
const FormData = require('form-data');
const recursive = require('recursive-fs');
const { parse } = require("csv-parse");
const basePathConverter = require('base-path-converter');
const url = `https://api.pinata.cloud/pinning/pinFileToIPFS`;
const imagesFolder = './output/images';
const metadataFolder = './output/metadata';

const fs = require("fs");
const dir = `${__dirname}/output/metadata/`;
const inputFiles = fs.readdirSync(dir).sort();

hashmetadata = '';

str = 'Image	Name	Price	Description	Metadata	Rarity';

const sendMetadataToPinata = (_folder) => {
  const src = _folder;
  
  recursive.readdirr(src, function (err, dirs, files) {
    let data = new FormData();
    files.forEach((file) => {
        //for each file stream, we need to include the correct relative file path
        data.append(`file`, fs.createReadStream(file), {
            filepath: basePathConverter(src, file)
        });
    });
  
  /*
    const metadata = JSON.stringify({
        name: 'testname',
        keyvalues: {
            exampleKey: 'exampleValue'
        }
    });
    data.append('pinataMetadata', metadata);
  */
  
    return axios
        .post(url, data, {
            maxBodyLength: 'Infinity', //this is needed to prevent axios from erroring out with large directories
            headers: {
                'Content-Type': `multipart/form-data; boundary=${data._boundary}`,
                pinata_api_key: 'f345a478e483047f4a0e',
                pinata_secret_api_key: '05fd351803b9f20aa7658ab4295476925d9cae5df7403ff54fc9d17b2b8fbe0a'
            }
        })
        .then(function (response) {
          hashmetadata = response.data.IpfsHash;
          let idr = 2;
          inputFiles.forEach((file) => {
            let id = file.split(".").shift();
            //let data = JSON.parse(fs.readFileSync(`${dir}/${file}`));
            idr++;
            /*fs.createReadStream("./output/_subTrait.csv")
            .pipe(parse({ delimiter: ",", from_line: 3 }))
            .on("data", function (row) {
              rar = row;
              console.log(row);
            })
            */
            meta = `https://piptle.mypinata.cloud/ipfs/${hashmetadata}/${id}.json`; 
        /*
            str += '\r\n';
            str += data.image;
            str += '	';
            str += data.name;
            str += '	';
            str += ' ';
            str += '	';
            str += data.description;
            str += '	';
            str += meta;
            str += '	';
            str += rar;               
        */

            let record;
            fs.createReadStream("./output/_subTrait.csv")
            .pipe(parse({ delimiter: ",", from_line: idr, to_line: idr }))
            .on("data", function (row) {

              record = {
                rar: row[19],
              };
              records.push(record);

            })
            .on('end', function () {
              //console.log(records);
              fs.writeFileSync(
                `./output/rar.json`,
                JSON.stringify(records)
              );

            });

          });
          //fs.writeFileSync("./output/input.txt", str);
          console.log('input');

          console.log(hashmetadata)
          //console.log(response);
            //handle response here

            inputFiles.forEach((file) => {
              let id = file.split(".").shift();
              let rar = JSON.parse(fs.readFileSync(`./output/rar.json`));
              let data = JSON.parse(fs.readFileSync(`${dir}/${file}`));
              let idn = 0;
              idn = file.split(".").shift();
              idn = Number(idn) - 1;
              console.log(id);
              console.log(rar[id-1].rar);
  
              meta = `https://piptle.mypinata.cloud/ipfs/${hashmetadata}/${id}.json`; 
          
              str += '\r\n';
              str += data.image;
              str += '	';
              str += data.name;
              str += '	';
              str += ' ';
              str += '	';
              str += data.description;
              str += '	';
              str += meta;
              str += '	';
              str += rar[id-1].rar;
              //console.log(str);
              fs.writeFileSync("./output/input.txt", str);
            });
            //console.log(str);
            fs.writeFileSync("./output/input.txt", str);

        })
        .catch(function (error) {
            //handle error here
        });
  });

};

const createInputVirtual = () => {

  //var hash = response.data.IpfsHash;

  inputFiles.forEach((file) => {
    let id = file.split(".").shift();
    let data = JSON.parse(fs.readFileSync(`${dir}/${file}`));

    meta = `https://piptle.mypinata.cloud/ipfs/${hashmetadata}/${id}.json`; 

    str += '\r\n';
    str += data.image;
    str += '	';
    str += data.name;
    str += '	';
    str += ' ';
    str += '	';
    str += data.description;
    str += '	';
    str += meta;  

  });
  fs.writeFileSync("./output/input.txt", str);
  console.log('input');

};

sendMetadataToPinata(metadataFolder);

//createInputVirtual();
