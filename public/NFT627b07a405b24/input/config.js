
      
      const fs = require("fs");
      const width = 4000;
      const height = 4000;
      const dir = __dirname;
      const name = "test 5 11052022";
      const description = "";
      const wallet = "";
      const hash = "627b07a405b24";
      const royalty = 0;
      const baseImageUri = "http://multiple-files.test/NFT627b07a405b24/output";
      const startEditionFrom = 1;
      const endEditionAt =20;
      const editionSize =20;
      const raceWeights = [
        {
          value: "skull",
          from: 1,
          to: editionSize,
        },
      ];

      const races = {
        skull: {
          name: "Skull",
          layers: [
              { 
                name: "Background",
                elements: [
                  {
                    id: 0,
                    name: "Orange",
                    path: `${dir}/parameter1/Orange.png`,
                    weight: 25,
                  },{
                    id: 1,
                    name: "Regular",
                    path: `${dir}/parameter1/Regular.png`,
                    weight: 25,
                  },{
                    id: 2,
                    name: "White",
                    path: `${dir}/parameter1/White.png`,
                    weight: 25,
                  },{
                    id: 3,
                    name: "Yellow",
                    path: `${dir}/parameter1/Yellow.png`,
                    weight: 25,
                  },
                    ],
                    position: { x: 0, y: 0 },
                    size: { width: width, height: height },
                  },
                  
              { 
                name: "Body",
                elements: [
                  {
                    id: 0,
                    name: "Skull",
                    path: `${dir}/parameter2/Skull.png`,
                    weight: 25,
                  },{
                    id: 1,
                    name: "SkullOrange",
                    path: `${dir}/parameter2/SkullOrange.png`,
                    weight: 25,
                  },{
                    id: 2,
                    name: "SkullRegular",
                    path: `${dir}/parameter2/SkullRegular.png`,
                    weight: 25,
                  },{
                    id: 3,
                    name: "SkullYellow",
                    path: `${dir}/parameter2/SkullYellow.png`,
                    weight: 25,
                  },
                    ],
                    position: { x: 0, y: 0 },
                    size: { width: width, height: height },
                  },
                  
              { 
                name: "Skin",
                elements: [
                  {
                    id: 0,
                    name: "BluePin",
                    path: `${dir}/parameter3/BluePin.png`,
                    weight: 25,
                  },{
                    id: 1,
                    name: "LunaBluePin",
                    path: `${dir}/parameter3/LunaBluePin.png`,
                    weight: 25,
                  },{
                    id: 2,
                    name: "Smiley",
                    path: `${dir}/parameter3/Smiley.png`,
                    weight: 25,
                  },{
                    id: 3,
                    name: "SmileYellow",
                    path: `${dir}/parameter3/SmileYellow.png`,
                    weight: 25,
                  },
                    ],
                    position: { x: 0, y: 0 },
                    size: { width: width, height: height },
                  },
                  
              { 
                name: "Facial Shape",
                elements: [
                  {
                    id: 0,
                    name: "GlassDome",
                    path: `${dir}/parameter4/GlassDome.png`,
                    weight: 25,
                  },{
                    id: 1,
                    name: "Headset",
                    path: `${dir}/parameter4/Headset.png`,
                    weight: 25,
                  },{
                    id: 2,
                    name: "Helmet",
                    path: `${dir}/parameter4/Helmet.png`,
                    weight: 25,
                  },{
                    id: 3,
                    name: "NFTHelmet",
                    path: `${dir}/parameter4/NFTHelmet.png`,
                    weight: 25,
                  },
                    ],
                    position: { x: 0, y: 0 },
                    size: { width: width, height: height },
                  },
                  
          ],
        },
      };

      module.exports = {
        width,
        height,
        name,
        description,
        wallet,
        royalty,
        hash,
        baseImageUri,
        editionSize,
        startEditionFrom,
        endEditionAt,
        races,
        raceWeights,
      };

      