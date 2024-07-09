const { src, dest, parallel, series, watch } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const ts = require("gulp-typescript");
const tsProject = ts.createProject("tsconfig.json");

function generateCSS(cb) {
    src("app/scss/**/*.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(dest("public/css"));
    cb();
}

function generateJS(cb) {
    tsProject.src().pipe(tsProject()).js.pipe(dest("public/js"));
    cb();
}

function generateIMG(cb) {
    src("app/images/**/*").pipe(dest(`public/images`));
    cb();
}

function generateHTML(cb) {
    src("app/*.html").pipe(dest("public"));
    cb();
}

function watchFiles() {
    watch("app/**.html", generateHTML);
    watch("app/scss/**.scss", generateCSS);
    watch("app/ts/*.ts", generateJS);
    watch("app/images/**/*", generateIMG);
}

exports.css = generateCSS;
exports.js = generateJS;
exports.html = generateHTML;
exports.img = generateIMG;
exports.watch = watchFiles;

exports.default = series(
    parallel(generateCSS, generateJS, generateIMG, generateHTML)
);
