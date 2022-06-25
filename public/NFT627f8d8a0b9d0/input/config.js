
      
      const fs = require("fs");
      const width = 4000;
      const height = 4000;
      const dir = __dirname;
      const name = "name";
      const description = "description";
      const wallet = "";
      const hash = "627f8d8a0b9d0";
      const royalty = 0;
      const baseImageUri = "http://multiple-files.test/NFT627f8d8a0b9d0/output";
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
                    name: "BluePin",
                    path: `${dir}/parameter4/BluePin.png`,
                    weight: 25,
                  },{
                    id: 1,
                    name: "LunaBluePin",
                    path: `${dir}/parameter4/LunaBluePin.png`,
                    weight: 25,
                  },{
                    id: 2,
                    name: "Smiley",
                    path: `${dir}/parameter4/Smiley.png`,
                    weight: 25,
                  },{
                    id: 3,
                    name: "SmileYellow",
                    path: `${dir}/parameter4/SmileYellow.png`,
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

      