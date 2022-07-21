//Código tomado de: https://github.com/zygisS22/color-palette-extraction/blob/master/index.html
//Créditos a: Zygimantas Sniurevicius
const buildPalette = (colorsList) => {
    const paletteContainer = document.getElementById("palette");
    const complementaryContainer = document.getElementById("complementary");
    // Si se quiere analizar varias imágenes se debe recargar la página y repetir el proceso
    paletteContainer.innerHTML = "";
    complementaryContainer.innerHTML = "";
  
    const orderedByColor = orderByLuminance(colorsList);
    const hslColors = convertRGBtoHSL(orderedByColor);
  
    for (let i = 0; i < orderedByColor.length; i++) {
      const hexColor = rgbToHex(orderedByColor[i]);
  
      const hexColorComplementary = hslToHex(hslColors[i]);
  
      if (i > 0) {
        const difference = calculateColorDifference(
          orderedByColor[i],
          orderedByColor[i - 1]
        );
  
        // Si la distancia es menor a 120 se omite ese color
        if (difference < 120) {
          continue;
        }
      }
  
      //Se crean los elementos que se adjuntaran al documento y mostraran los colores
      const colorElement = document.createElement("div");
      colorElement.style.backgroundColor = hexColor;
      colorElement.appendChild(document.createTextNode(hexColor));
      paletteContainer.appendChild(colorElement);
      //Se entra al if cuando el color hsl no es negro/blanco/gris
      if (hslColors[i].h) {
        const complementaryElement = document.createElement("div");
        complementaryElement.style.backgroundColor = `hsl(${hslColors[i].h},${hslColors[i].s}%,${hslColors[i].l}%)`;
  
        complementaryElement.appendChild(
          document.createTextNode(hexColorComplementary)
        );
        complementaryContainer.appendChild(complementaryElement);
      }
    }
  };
  
  // Convierte cada valor del pixel (es decir, un número) a hexadecimal (a una variable tipo String) con base 16 
  const rgbToHex = (pixel) => {
    const componentToHex = (c) => {
      const hex = c.toString(16);
      return hex.length == 1 ? "0" + hex : hex;
    };
  
    return (
      "#" +
      componentToHex(pixel.r) +
      componentToHex(pixel.g) +
      componentToHex(pixel.b)
    ).toUpperCase();
  };
  
  /**
   * Convertir HSL a Hex
   * this entire formula can be found in stackoverflow, credits to @icl7126 !!!
   * https://stackoverflow.com/a/44134328/17150245
   */
  const hslToHex = (hslColor) => {
    const hslColorCopy = { ...hslColor };
    hslColorCopy.l /= 100;
    const a =
      (hslColorCopy.s * Math.min(hslColorCopy.l, 1 - hslColorCopy.l)) / 100;
    const f = (n) => {
      const k = (n + hslColorCopy.h / 30) % 12;
      const color = hslColorCopy.l - a * Math.max(Math.min(k - 3, 9 - k, 1), -1);
      return Math.round(255 * color)
        .toString(16)
        .padStart(2, "0");
    };
    return `#${f(0)}${f(8)}${f(4)}`.toUpperCase();
  };
  
  /**
   * Convertir valores RGB a HSL
   * This formula can be
   * found here https://www.niwa.nu/2013/05/math-behind-colorspace-conversions-rgb-hsl/
   */
  const convertRGBtoHSL = (rgbValues) => {
    return rgbValues.map((pixel) => {
      let hue,
        saturation,
        luminance = 0;
  
      // Inicialmente, se cambia el rango de 0-255 a 0-1
      let redOpposite = pixel.r / 255;
      let greenOpposite = pixel.g / 255;
      let blueOpposite = pixel.b / 255;
  
      const Cmax = Math.max(redOpposite, greenOpposite, blueOpposite);
      const Cmin = Math.min(redOpposite, greenOpposite, blueOpposite);
  
      const difference = Cmax - Cmin;
  
      luminance = (Cmax + Cmin) / 2.0;
  
      if (luminance <= 0.5) {
        saturation = difference / (Cmax + Cmin);
      } else if (luminance >= 0.5) {
        saturation = difference / (2.0 - Cmax - Cmin);
      }
  
      /**
       * Si Rojo es máximo, entonces Iluminación = (G-B)/(max-min)
       * Si Verde es máximo, entonces Iluminación = 2.0+(B-R)/(max-min)
       * Si azul es máximo, entonces Ilumincación = 4.0 + (R-G)/(max-min)
       */
      const maxColorValue = Math.max(pixel.r, pixel.g, pixel.b);
  
      if (maxColorValue === pixel.r) {
        hue = (greenOpposite - blueOpposite) / difference;
      } else if (maxColorValue === pixel.g) {
        hue = 2.0 + (blueOpposite - redOpposite) / difference;
      } else {
        hue = 4.0 + (greenOpposite - blueOpposite) / difference;
      }
  
      hue = hue * 60; // Se encuentra el sector de 60° a la cual el color pertenece
  
      // Siempre debe ser positivo el ángulo
      if (hue < 0) {
        hue = hue + 360;
      }
  
      //Cuando todos los tres (R,G y B) son iguales, se obtiene un color neutral (Blanco, gris o negro)
      if (difference === 0) {
        return false;
      }
  
      return {
        h: Math.round(hue) + 180, //Se suma 180° porque ese es el color complementario
        s: parseFloat(saturation * 100).toFixed(2),
        l: parseFloat(luminance * 100).toFixed(2),
      };
    });
  };
  
  /**
   * Usando iluminación relativa, se ordena el brillo de los colores
   * la explicación de esta temática se encuentra aquí: -> https://en.wikipedia.org/wiki/Luma_(video)
   */
  const orderByLuminance = (rgbValues) => {
    const calculateLuminance = (p) => {
      return 0.2126 * p.r + 0.7152 * p.g + 0.0722 * p.b;
    };
  
    return rgbValues.sort((p1, p2) => {
      return calculateLuminance(p2) - calculateLuminance(p1);
    });
  };
  
  const buildRgb = (imageData) => {
    const rgbValues = [];    
    // Se itera cada cuatro veces debido a que se debe obtener de la información de la imagen los valores de rojo, verde, azul y alfa.
    for (let i = 0; i < imageData.length; i += 4) {
      const rgb = {
        r: imageData[i],
        g: imageData[i + 1],
        b: imageData[i + 2],
      };
  
      rgbValues.push(rgb);
    }
  
    return rgbValues;
  };
  
  /**
   * Calcular la distancia del color o la diferencia entre dos colores
   *
   * Para mayor explicación: -> https://en.wikipedia.org/wiki/Euclidean_distance
   * Nota: este método no es preciso, para mejores resultados usar la métrica Delta-E 
   */
  const calculateColorDifference = (color1, color2) => {
    const rDifference = Math.pow(color2.r - color1.r, 2);
    const gDifference = Math.pow(color2.g - color1.g, 2);
    const bDifference = Math.pow(color2.b - color1.b, 2);
  
    return rDifference + gDifference + bDifference;
  };
  
  // Retorna que canal de color tiene la mayor diferencia
  const findBiggestColorRange = (rgbValues) => {
    /**
     * Min se inicializa en el máximo valor posible
     * de aquí se procede a encontrar el valor mínimo para ese canal de color
     *
     * Max se inicializa en el mínimo valor posible
     * de aquí se procede a encontrar el valor máximo para ese canal de color
     */
    let rMin = Number.MAX_VALUE;
    let gMin = Number.MAX_VALUE;
    let bMin = Number.MAX_VALUE;
  
    let rMax = Number.MIN_VALUE;
    let gMax = Number.MIN_VALUE;
    let bMax = Number.MIN_VALUE;
  
    rgbValues.forEach((pixel) => {
      rMin = Math.min(rMin, pixel.r);
      gMin = Math.min(gMin, pixel.g);
      bMin = Math.min(bMin, pixel.b);
  
      rMax = Math.max(rMax, pixel.r);
      gMax = Math.max(gMax, pixel.g);
      bMax = Math.max(bMax, pixel.b);
    });
  
    const rRange = rMax - rMin;
    const gRange = gMax - gMin;
    const bRange = bMax - bMin;
  
    // Se determina cual color tiene la mayor diferencia
    const biggestRange = Math.max(rRange, gRange, bRange);
    if (biggestRange === rRange) {
      return "r";
    } else if (biggestRange === gRange) {
      return "g";
    } else {
      return "b";
    }
  };
  
  /**
   * Implementaci "Median cut"
   * para mayor información -> https://en.wikipedia.org/wiki/Median_cut
   */
  const quantization = (rgbValues, depth) => {
    const MAX_DEPTH = 4;
  
    // Base case
    if (depth === MAX_DEPTH || rgbValues.length === 0) {
      const color = rgbValues.reduce(
        (prev, curr) => {
          prev.r += curr.r;
          prev.g += curr.g;
          prev.b += curr.b;
  
          return prev;
        },
        {
          r: 0,
          g: 0,
          b: 0,
        }
      );
  
      color.r = Math.round(color.r / rgbValues.length);
      color.g = Math.round(color.g / rgbValues.length);
      color.b = Math.round(color.b / rgbValues.length);
  
      return [color];
    }
  
    /**
     *  Recursivamente hace lo siguiente:
     *  1. Encuentra el canal del pixel (rojo, verde o azul) con la mayor diferencia/rango
     *  2. Ordena este canal
     *  3. Divide por la mitad la lista de colores rgb
     *  4. Se repite el proceso, hasta que se obtenga la profundidad deseada 
     */
    const componentToSortBy = findBiggestColorRange(rgbValues);
    rgbValues.sort((p1, p2) => {
      return p1[componentToSortBy] - p2[componentToSortBy];
    });
  
    const mid = rgbValues.length / 2;
    return [
      ...quantization(rgbValues.slice(0, mid), depth + 1),
      ...quantization(rgbValues.slice(mid + 1), depth + 1),
    ];
  };
  
  const main = () => {
    const imgFile = document.getElementById("imgfile");
    const image = new Image();
    const file = imgFile.files[0];
    const fileReader = new FileReader();
  
    // Cuando el archivo imagen es cargado, se procede a extraer la información de la imagen.
    fileReader.onload = () => {
      image.onload = () => {
        // Establece el tamaño del canvas para ser el mismo de la imagen cargada
        const canvas = document.getElementById("canvas");
        canvas.width = image.width;
        canvas.height = image.height;
        const ctx = canvas.getContext("2d");
        ctx.drawImage(image, 0, 0);
  
        /**
         * getImageData retorna un array lleno de valores RGBA
         * cada pixel consist en 4 valores, el valor de rojo, verde, azul y alfa
         * (transparencia). Por razones de coherencia de valores de matriz,
         * el alpha no es de 0 a 1 como en el RGBA de CSS, sino de 0 a 255.
         */
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  
        // Convierte la información de la imagen a valores RGB, con el objetivo de simplificar el proceso
        const rgbArray = buildRgb(imageData.data);
  
        /**
         * Cuantización de Color 
         * Es un proceso que reduce el número de colores usados en una imagen
         * mientras se intenta visualizamente mantener la imagen original lo máximo posible
         */
        const quantColors = quantization(rgbArray, 0);
  
        // Se crea la estructura HTML para mostrar la paleta de colores
        buildPalette(quantColors);
      };
      image.src = fileReader.result;
    };
    fileReader.readAsDataURL(file);
  };
  
  main();