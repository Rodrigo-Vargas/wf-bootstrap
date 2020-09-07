module.exports = {
   mode: 'development',
   entry: {
      'index.build': './src/index.js'
   },
   output: {
      path: __dirname + '/dist'
   },
   module: {
      rules: [
         {
            test: /\.js$/,
            exclude: /node_modules\/.*/,
            use:
            {
               loader: require.resolve('babel-loader'),
               options: {
                  presets: ['@babel/preset-env']
               }
            }
         }
      ]
   }
};