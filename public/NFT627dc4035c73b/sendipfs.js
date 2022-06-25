//imports needed for this function

const axios = require('axios');
const FormData = require('form-data');
const recursive = require('recursive-fs');
const basePathConverter = require('base-path-converter');
const url = `https://api.pinata.cloud/pinning/pinFileToIPFS`;
const imagesFolder = './output/images';
const metadataFolder = './output/metadata';

const fs = require("fs");
const inputFiles = fs.readdirSync(`./output/metadata/`).sort;


const sendImagesToPinata = (_folder) => {
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
          var hash = response.data.IpfsHash;

          inputFiles.forEach((file) => {
            let id = file.split(".").shift();
            let data = JSON.parse(fs.readFileSync(`./output/metadata/${file}`));

            data.image = `ipfs://${hash}/${id}.png`;
            
            fs.writeFileSync(`./output/metadata/${file}` , JSON.stringify(data, null, 2));
            console.log(data.image);

          });
          
          console.log(hash)
          //console.log(response);
            //handle response here
        })
        .catch(function (error) {
            //handle error here
        });
  });

};

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
          var hash = response.data.IpfsHash;
          console.log(hash)
          //console.log(response);
            //handle response here
        })
        .catch(function (error) {
            //handle error here
        });
  });

};

sendImagesToPinata(imagesFolder);
sendMetadataToPinata(metadataFolder);
