
      
      const fs = require("fs");
      const width = 3000;
      const height = 3000;
      const dir = __dirname;
      const name = "";
      const description = "";
      const wallet = "";
      const hash = "";
      const royalty = 0;
      const baseImageUri = "http://multiple-files.test/NFT/output";
      const startEditionFrom = 1;
      const endEditionAt =;
      const editionSize =;
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

      