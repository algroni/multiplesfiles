
      
      const fs = require("fs");
      const width = 3000;
      const height = 3000;
      const dir = __dirname;
      const description = "NFT Collection";
      const baseImageUri = "http://multiple-files.test/NFT62390ec341916/output";
      const startEditionFrom = 1;
      const endEditionAt =30;
      const editionSize =30;
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
                    name: "Blue",
                    path: `${dir}/parameter1/Blue.png`,
                    weight: 25,
                  },{
                    id: 1,
                    name: "LightBlue",
                    path: `${dir}/parameter1/LightBlue.png`,
                    weight: 25,
                  },{
                    id: 2,
                    name: "Orange",
                    path: `${dir}/parameter1/Orange.png`,
                    weight: 25,
                  },{
                    id: 3,
                    name: "Pink",
                    path: `${dir}/parameter1/Pink.png`,
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
                    name: "Orange",
                    path: `${dir}/parameter2/Orange.png`,
                    weight: 25,
                  },{
                    id: 1,
                    name: "Regular",
                    path: `${dir}/parameter2/Regular.png`,
                    weight: 25,
                  },{
                    id: 2,
                    name: "White",
                    path: `${dir}/parameter2/White.png`,
                    weight: 25,
                  },{
                    id: 3,
                    name: "Yellow",
                    path: `${dir}/parameter2/Yellow.png`,
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
                    name: "Skull",
                    path: `${dir}/parameter3/Skull.png`,
                    weight: 25,
                  },{
                    id: 1,
                    name: "SkullOrange",
                    path: `${dir}/parameter3/SkullOrange.png`,
                    weight: 25,
                  },{
                    id: 2,
                    name: "SkullRegular",
                    path: `${dir}/parameter3/SkullRegular.png`,
                    weight: 25,
                  },{
                    id: 3,
                    name: "SkullYellow",
                    path: `${dir}/parameter3/SkullYellow.png`,
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
        description,
        baseImageUri,
        editionSize,
        startEditionFrom,
        endEditionAt,
        races,
        raceWeights,
      };

      