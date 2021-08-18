module.exports = {
  plugins: {
    "postcss-import": {},
    "postcss-preset-env": {
      stage: 4,
      browsers: ["last 5 versions", "not ie <= 8"],
    },
  },
};
