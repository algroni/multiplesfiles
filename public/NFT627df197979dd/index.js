//imports needed for this function

const axios = require('axios');
const FormData = require('form-data');
const recursive = require('recursive-fs');
const basePathConverter = require('base-path-converter');
const url = `https://api.pinata.cloud/pinning/pinFileToIPFS`;
const imagesFolder = './output/images';
const metadataFolder = './output/metadata';

const dir = `${__dirname}/output/metadata/`;
const fs = require("fs");
const inputFiles = fs.readdirSync(dir).sort();

const { createCanvas, loadImage } = require("canvas");
const {
  width,
  height,
  name,
  description,
  baseImageUri,
  editionSize,
  startEditionFrom,
  endEditionAt,
  races,
  raceWeights,
} = require("./input/config.js");
const console = require("console");
const canvas = createCanvas(width, height);
const canvasm = createCanvas(800, 800);
const ctx = canvas.getContext("2d");
const ctxm = canvasm.getContext("2d");
var metadataList = [];
var attributesList = [];
var st = [];
var sts = [];
var subTrait = [];
var dnaList = [];
var percen_trait = [];
var total = [];
var ct = [];
var st = [];
var esc = 0;

const saveImage = (_editionCount) => {
  fs.writeFileSync(
    `./output/images/${_editionCount}.png`,
    canvas.toBuffer("image/png")
  );

  fs.writeFileSync(
    `./output/images/${_editionCount}min.png`,
    canvasm.toBuffer("image/png")
  );

};

const signImage = (_sig) => {
  ctx.fillStyle = "#ffffff";
  ctx.font = "bold 30pt Verdana";
  ctx.textBaseline = "top";
  ctx.textAlign = "left";
  ctx.fillText(_sig, 40, 40);
/*
  ctxm.fillStyle = "#ffffff";
  ctxm.font = "bold 30pt Verdana";
  ctxm.textBaseline = "top";
  ctxm.textAlign = "left";
  ctxm.fillText(_sig, 40, 40);
*/
};

const genColor = () => {
  let hue = Math.floor(Math.random() * 360);
  let pastel = `hsl(${hue}, 100%, 85%)`;
  return pastel;
};

const drawBackground = () => {
  ctx.fillStyle = genColor();
  ctx.fillRect(0, 0, width, height);
};

const addMetadata = (_dna, _edition) => {
  let dateTime = Date.now();
  let tempMetadata = {
    dna: _dna.join(""),
    name: `${name}#${_edition}`,
    description: description,
    image: `${baseImageUri}/images/${_edition}.png`,
    edition: _edition,
    date: dateTime,
    attributes: attributesList,
  };
  metadataList.push(tempMetadata);
  attributesList = [];
};

const addAttributes = (_element) => {
  let selectedElement = _element.layer.selectedElement;
  attributesList.push({
    trait_type: _element.layer.name,
    value: selectedElement.name,
  });
};

const getPerc = (_element, _count) => {
  let selectedElement = _element.layer.selectedElement;
  let trait = {
    nft_id: _count,
    core_trait: _element.layer.name,
    sub_trait: selectedElement.name,
    percent: 0,
  };
  subTrait.push(trait);
};

const loadLayerImg = async (_layer) => {
  return new Promise(async (resolve) => {
    const image = await loadImage(`${_layer.selectedElement.path}`);
    resolve({ layer: _layer, loadedImage: image });
  });
};

const drawElement = (_element) => {
  ctx.drawImage(
    _element.loadedImage,
    _element.layer.position.x,
    _element.layer.position.y,
    _element.layer.size.width,
    _element.layer.size.height
  );

  ctxm.drawImage(
    _element.loadedImage,
    _element.layer.position.x,
    _element.layer.position.y,
    800,
    800
  );

  addAttributes(_element);
};

const constructLayerToDna = (_dna = [], _races = [], _race) => {
  let mappedDnaToLayers = _races[_race].layers.map((layer, index) => {
    let selectedElement = layer.elements.find((e) => e.id == _dna[index]);
    return {
      name: layer.name,
      position: layer.position,
      size: layer.size,
      selectedElement: selectedElement,
    };
  });

  return mappedDnaToLayers;
};

const getRace = (_editionCount) => {
  let race = "No Race";
  raceWeights.forEach((raceWeight) => {
    if (_editionCount >= raceWeight.from && _editionCount <= raceWeight.to) {
      race = raceWeight.value;
    }
  });
  return race;
};

const isDnaUnique = (_DnaList = [], _dna = []) => {
  let foundDna = _DnaList.find((i) => i.join("") === _dna.join(""));
  return foundDna == undefined ? true : false;
};

const getPercentage = (_SubTrait = []) => {

  a = 0;
  attributList = [];


  var counts = [];
  for (var k = 0; k < dnaList[0].length; k++) {
    for (var i = 0; i < dnaList.length; i++) {
       
       for (var j = 0; j < dnaList[0].length; j++) {

            if (j == k){
              a = dnaList[i][k];
              counts[a] = 1 + (counts[a] || 0);

          }

       }
     }
     
     st.push(counts)
     counts = [];
  }

  var s = [];
  for (var i = 0; i < dnaList.length; i++) {
    
    for (var j = 0; j < dnaList[0].length; j++) {
      
      b = dnaList[i][j];
      
      s.push(st[j][b]*100/endEditionAt);
      let ptrait = {
        percent: st[j][b]*100/endEditionAt,
      };
      percen_trait.push(ptrait);
      
    }

    sts.push(s);
    subTrait.percen_trait = s;
    g = i+1;
    
    s = [];
  }

};

/*
const createDna = (_races, _race) => {
  let randNum = [];
  _races[_race].layers.forEach((layer) => {
    let randElementNum = Math.floor(Math.random() * 100);
    let num = 0;
    layer.elements.forEach((element) => {
      if (randElementNum >= 100 - element.weight) {
        num = element.id;
      }
    });
    randNum.push(num);
  });
  return randNum;
};
*/
/*
const createDna = (_races, _race) => {
  let randNum = [];
  _races[_race].layers.forEach((layer) => {
    let randElementNum = 0;
    let num = 0;
    let e = 0;
      while ( e == 0){
      layer.elements.forEach((element) => {
        randElementNum = Math.floor(Math.random() * 100);
        if (randElementNum >= 100 - element.weight && e == 0) {
          num = element.id;
          e = 1;
        }
      });
    }
    e = 0;
    randNum.push(num);
  });
  return randNum;
}; */

const totalData = () => {
  races['skull'].layers.forEach((layer) => {
  let quant = [];
  layer.elements.forEach((element) => {
    quant.push(element.weight*editionSize/100);
  });
  total.push(quant);
});
};

const createDna = (_races, _race) => {
  let randNum = [];
  let c = 0;
  let s = 0;
  
  _races[_race].layers.forEach((layer) => {
    let randElementNum = 0;
    let num = 0;
    let e = 0;
    
    while ( e == 0){
      layer.elements.forEach((element) => {
        randElementNum = Math.floor(Math.random() * 100);
        if (randElementNum >= 100 - element.weight && e == 0 && total[c][s] != 0) {
          num = element.id;
          e = 1;
          total[c][s] = total[c][s] - 1;
          ct.push(c);
          st.push(s);
        }
        s++;
      });
      s = 0;
    }
    randNum.push(num);
    e = 0;
    c++;
  });
  return randNum;
};

const writeMetaData = (_data, _subtrait) => {
  //fs.writeFileSync("./output/_metadata.json", _data);
  fs.writeFileSync("./output/_subTrait.csv", _subtrait);
};

const saveMetaDataSingleFile = (_editionCount) => {
  fs.writeFileSync(
    `./output/metadata/${_editionCount}.json`,
    JSON.stringify(metadataList.find((meta) => meta.edition == _editionCount))
  );
};

const startCreating = async () => {
  writeMetaData("", "");
  totalData();
  let editionCount = startEditionFrom;
  while (editionCount <= endEditionAt) {
    let race = getRace(editionCount);
    let newDna = createDna(races, race);

    if (isDnaUnique(dnaList, newDna)) {
      let results = constructLayerToDna(newDna, races, race);
      let loadedElements = []; //promise array
      results.forEach((layer) => {
        loadedElements.push(loadLayerImg(layer));
      });

      await Promise.all(loadedElements).then((elementArray) => {
        ctx.clearRect(0, 0, width, height);
        ctxm.clearRect(0, 0, 800, 800);
        // drawBackground();
        elementArray.forEach((element) => {
          drawElement(element);
          getPerc(element, editionCount);
        });
        signImage(``);
        saveImage(editionCount);
        addMetadata(newDna, editionCount);
        saveMetaDataSingleFile(editionCount);
        //console.log(
        //  `Created edition: ${editionCount}, Race: ${race} with DNA: ${newDna}`
        //);
      });
      dnaList.push(newDna);
      editionCount++;
      ct = [];
      st = [];      
    } else {

      esc++;
      for (var k = 0; k < ct.length; k++) {
        total[ct[k]][st[k]] = total[ct[k]][st[k]] + 1;
      }

      ct = [];
      st = [];

      if (esc == 1000){
        total = [];
        totalData();
      }

      //console.log("DNA exists!");
    }
  }
  getPercentage(subTrait);

  for (var i = 0; i < subTrait.length; i++) {
      subTrait[i].percent = percen_trait[i].percent;
  }

/* Metadata NFT  
  var str = 'NFT,Core Trait,Sub Trait,Percentage'+ '\r\n';

  for (var i = 0; i < subTrait.length; i++) {
      var line = '';
      for (var index in subTrait[i]) {
          if (line != '') line += ','

          line += subTrait[i][index];
      }

      str += line + '\r\n';
  }
*/

var cores = '';
var str=',';

races['skull'].layers.forEach((layer) => {
  layer.elements.forEach((element) => {
    if(cores == ''){
      str += layer.name;
      str += ',';
      cores = layer.name;
    }else{
      if (cores != layer.name){
        str += layer.name;
        str += ',';
        cores = layer.name;
      }else{
        str += ',';
      }
    }

  });
});
str += '\r\n';
str += 'NFT id ,';

races['skull'].layers.forEach((layer) => {
  layer.elements.forEach((element) => {
      str += element.name;
      str += ',';
  });
});
str += 'AVERAGE RARITY, STATISTICAL RARITY, RARITY SCORE';

var avesum=0;
var avecon=0;
var stapro=1;
var staprt=1;
var averag=0;
var static=0;
var scosum=0;
var rarsco=0;

var idnft = 0;

for (var i = 0; i < subTrait.length; i++) {
    var line = '';
      
        if (idnft != subTrait[i]['nft_id']){
          if(avesum > 0 ){
            averag=avesum/avecon;
            static=stapro*100/staprt;
            rarsco=scosum;
            str += averag+',';
            str += static+',';
            str += rarsco;
            avesum=0;
            avecon=0;
            scosum=0;
            stapro=1;
            staprt=1;
          }

          str += '\r\n'
          idnft = subTrait[i]['nft_id'];
          line += subTrait[i]['nft_id'];
          if (line != '') line += ','
        }

        races['skull'].layers.forEach((layer) => {
          layer.elements.forEach((element) => {
            if (layer.name == subTrait[i]['core_trait']){
              if(subTrait[i]['sub_trait'] == element.name){
                line += subTrait[i]['percent'];
                line += '%,';
              }else{
                line += '0,';
              }
            }
          });
        });

        avesum=avesum+subTrait[i]['percent'];
        avecon++;
        stapro=stapro*subTrait[i]['percent'];
        staprt=staprt*100;   
        
        scosum=scosum+100/subTrait[i]['percent'];         

        if( i == subTrait.length - 1 ){
          averag=avesum/avecon;
          static=stapro*100/staprt;
          rarsco=scosum;
          line += averag+',';
          line += static+',';
          line += rarsco;
          avesum=0;
          avecon=0;
          scosum=0;
          stapro=1;
          staprt=1;
        }

    str += line; 

}
idnft = 0;

writeMetaData(JSON.stringify(metadataList), str);
};

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
            let data = JSON.parse(fs.readFileSync(`${dir}/${file}`));

            data.image = `https://piptle.mypinata.cloud/ipfs/${hash}/${id}.png`;
            
            fs.writeFileSync(`${dir}/${file}` , JSON.stringify(data, null, 2));
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

startCreating();

//sendImagesToPinata(imagesFolder);
//sendMetadataToPinata(metadataFolder);
