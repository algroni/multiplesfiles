const fs = require("fs");
const { createCanvas, loadImage } = require("canvas");
const {
  width,
  height,
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
const ctx = canvas.getContext("2d");
var metadataList = [];
var attributesList = [];
var st = [];
var sts = [];
var subTrait = [];
var dnaList = [];

const saveImage = (_editionCount) => {
  fs.writeFileSync(
    `./output/${_editionCount}.png`,
    canvas.toBuffer("image/png")
  );
};

const signImage = (_sig) => {
  ctx.fillStyle = "#ffffff";
  ctx.font = "bold 30pt Verdana";
  ctx.textBaseline = "top";
  ctx.textAlign = "left";
  ctx.fillText(_sig, 40, 40);
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
    name: `#${_edition}`,
    description: description,
    image: `${baseImageUri}/${_edition}.png`,
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
  /*for(var i = 0; i < _SubTrait.length; i++) {
      var obj = _SubTrait[i];
      console.log(obj.id);
  }*/
  //j = 0;
  /*b1 = 0;
  b21 = 0;
  b31 = '';
  s2 = 0;
  s21 = 0;
  s31 = '';
  s3 = 0;
  s22 = 0;
  s32 = '';
  p4 = 0;
  p21 = 0;
  p31 = '';
  s5 = 0;
  s23 = 0;
  s33 = '';
  f6 = 0;
  f21 = 0;
  f31 = '';
  m7 = 0;
  m21 = 0;
  m31 = '';
  h8 = 0;
  h22 = 0;
  h32 = '';
  a9 = 0;
  a21 = 0;
  a31 = '';
  h0 = 0;
  h21 = 0;
  h31 = '';*/
  a = 0;
  attributList = [];

  //console.log(_SubTrait[0]['sub_trait'])
  //console.log(dnaList[0].length)
  //console.log(dnaList.length)

  var counts = [];
  for (var k = 0; k < dnaList[0].length; k++) {
    for (var i = 0; i < dnaList.length; i++) {
       //counts[arr[i]] = 1 + (counts[arr[i]] || 0);
       for (var j = 0; j < dnaList[0].length; j++) {

          //counts[a] = 1 + (counts[a] || 0);
          //console.log(a)
          /*if (j == dnaList[0].length - 1){
            counts[a] = 1 + (counts[a] || 0);
          }*/

            if (j == k){
              a = dnaList[i][k];
              counts[a] = 1 + (counts[a] || 0);

          }

       }
     }
     //console.log(counts)
     st.push(counts)
     counts = [];
  }
  /*console.log(st)
  console.log(st[0])
  console.log(st[0][0])
  console.log(dnaList[0].length)*/
  var s = [];
  for (var i = 0; i < dnaList.length; i++) {
    //console.log(' i: ' + i );
    for (var j = 0; j < dnaList[0].length; j++) {
      //console.log(' j: ' + j );
      b = dnaList[i][j];
      //console.log('j: ' + j + ' i: ' + i + ' b: ' + b);
      s.push(st[j][b]*100/endEditionAt);
      //console.log(' s: ' + st[i][b]*100/endEditionAt );
    }
    sts.push(s);
    g = i+1;
    console.log(' s'+g+': ' + s );
    s = [];
  }
  //console.log(' sts: ' + sts );
  //console.log(counts)

  /*console.log(counts)
  console.log(counts[0])
  console.log(counts[1])
  console.log(counts[2])
  console.log(counts[3])
  console.log(counts[4])
  console.log(counts[5])*/

  /*Object.keys(_SubTrait).forEach(function(key) {

    Object.keys(_SubTrait[key]).forEach(function(i) {
      //console.log(i)
      if(JSON.stringify(_SubTrait[key][i]) == '"Background"' || b1 == 1){
        b1++;
      }
      if (b1 == 2){
        //console.log('Key : ' + i + ', Value : ' + JSON.stringify(_SubTrait[key][i]))
        if (b31 == ''){
          b31 = JSON.stringify(_SubTrait[key][i]);
        }
        b1 = 0;
      }
      if(JSON.stringify(_SubTrait[key][i]) == '"Suit"' || s2 == 1){
        s2++;
      }
      if (s2 == 2){
        //console.log('Key : ' + i + ', Value : ' + JSON.stringify(_SubTrait[key][i]))
        if (s31 == ''){
          s31 = JSON.stringify(_SubTrait[key][i]);
        }
        s2 = 0;
      }
      if(JSON.stringify(_SubTrait[key][i]) == '"Shoulder"' || s3 == 1){
        s3++;
      }
      if (s3 == 2){
        //console.log('Key : ' + i + ', Value : ' + JSON.stringify(_SubTrait[key][i]))
        if (s32 == ''){
          s32 = JSON.stringify(_SubTrait[key][i]);
        }
        s3 = 0;
      }
      if(JSON.stringify(_SubTrait[key][i]) == '"Pin"' || p4 == 1){
        p4++;
      }
      if (p4 == 2){
        //console.log('Key : ' + i + ', Value : ' + JSON.stringify(_SubTrait[key][i]))
        if (p31 == ''){
          p31 = JSON.stringify(_SubTrait[key][i]);
        }
        p4 = 0;
      }
      if(JSON.stringify(_SubTrait[key][i]) == '"Headwear"' || h0 == 1){
        h0++;
      }
      if (h0 == 2){
        //console.log('Key : ' + i + ', Value : ' + JSON.stringify(_SubTrait[key][i]))
        h0 = 0;
        if (h31 == ''){
          h31 = JSON.stringify(_SubTrait[key][i]);
        }
      }

    })

  })*/


  /*console.log('Value : ' + b31 + ' - Percentage: ' + b21*100/endEditionAt + '%')
  console.log('Value : ' + s31 + ' - Percentage: ' + s21*100/endEditionAt + '%')
  console.log('Value : ' + s32 + ' - Percentage: ' + s22*100/endEditionAt + '%')
  console.log('Value : ' + p31 + ' - Percentage: ' + p21*100/endEditionAt + '%')
  console.log('Value : ' + h31 + ' - Percentage: ' + h21*100/endEditionAt + '%')*/
};

const createDna = (_races, _race) => {
  let randNum = [];
  _races[_race].layers.forEach((layer) => {
    let randElementNum = Math.floor(Math.random() * 10);
    //console.log('Value : ' + randElementNum )
    let num = 0;
    //num = randElementNum;
    /*layer.elements.forEach((element) => {
      if (randElementNum >= 100 - element.weight) {
        num = element.id;
      }
    });*/
    layer.elements.forEach((element) => {
        num++;
    });
    randElementNum = Math.floor(Math.random() * num);
    num = 0;
    randNum.push(randElementNum);
  });
  //console.log('Value : ' + randNum )
  return randNum;
};

const writeMetaData = (_data, _subtrait) => {
  fs.writeFileSync("./output/_metadata.json", _data);
  fs.writeFileSync("./output/_subTrait.json", _subtrait);
};

const saveMetaDataSingleFile = (_editionCount) => {
  fs.writeFileSync(
    `./output/${_editionCount}.json`,
    JSON.stringify(metadataList.find((meta) => meta.edition == _editionCount))
  );
};

const startCreating = async () => {
  writeMetaData("", "");
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
        // drawBackground();
        elementArray.forEach((element) => {
          drawElement(element);
          getPerc(element, editionCount);
        });
        signImage(``);
        saveImage(editionCount);
        addMetadata(newDna, editionCount);
        saveMetaDataSingleFile(editionCount);
        console.log(
          `Created edition: ${editionCount}, Race: ${race} with DNA: ${newDna}`
        );
      });
      dnaList.push(newDna);
      editionCount++;
    } else {
      console.log("DNA exists!");
    }
  }
  getPercentage(subTrait);

  writeMetaData(JSON.stringify(metadataList), JSON.stringify(subTrait));
};

startCreating();
