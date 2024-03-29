const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#fb5d5d",

                    secondary: "#30f4b6",

                    accent: "#96f7f4",

                    neutral: "#211C2B",

                    "base-100": "#FCFCFD",

                    info: "#8E9EDC",

                    success: "#23A98A",

                    warning: "#F2D12C",

                    error: "#DC3232",
                },
            },
        ],
    },
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        container: {
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "4rem",
                xl: "5rem",
                "2xl": "6rem",
            },
        },
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                red: {
                    50: "#fef2f2",
                    100: "#ffe1e1",
                    200: "#ffc9c9",
                    300: "#fea3a3",
                    400: "#fb5d5d",
                    500: "#f34040",
                    600: "#e12121",
                    700: "#bd1818",
                    800: "#9c1818",
                    900: "#811b1b",
                },
            },
            boxShadow: {
                xl: "0px 0px 5px linear-gradient( to right, #ffffff , #fffacc)",
            },
        },
    },

    plugins: [require("daisyui")],
};
