
var counts = (text) => {
    var characterCount = text.length;
    var words = text.trim().split(/\s+/);
    var wordCount = text.trim().length > 0 ? words.length : 0;
    var extraSpaces = (text.match(/\s{2,}/g) || []).length;
    return {
        characterCount: characterCount,
        wordCount: wordCount,
        extraSpaces: extraSpaces,
    };
};