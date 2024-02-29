const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .enableSassLoader()
    .addEntry('app', './assets/app.js')
    .addEntry('preview', './assets/preview.js')
    .addEntry('externalMedia', './assets/externalMedia.js')
    .addEntry('paginateHome', './assets/paginateHome.js')
    .addEntry('paginateComment', './assets/paginateComment.js')
    .copyFiles({
        from: './assets/img',
        to: 'images/[path][name].[hash:8].[ext]'
    })
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })
;

module.exports = Encore.getWebpackConfig();
