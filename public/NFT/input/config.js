
      
      const fs = require("fs");
      const width = 3000;
      const height = 3000;
      const dir = __dirname;
      const description = "This is an NFT made by the coolest generative code.";
      const baseImageUri = "https://hashlips/nft";
      const startEditionFrom = 1;
      const endEditionAt =1;
      const editionSize =1;
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

      