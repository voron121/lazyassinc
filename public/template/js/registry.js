/**
 * Registry storage
 * Singleton
 */
class Registry
{
    static storage = [];

    /**
     * Will add data into object.
     * Will erase old data with the same key
     * @param key
     * @param value
     */
    static set(key, value) {
        this.storage[key] = value;
    }

    /**
     * Will return data by key
     * @param key
     * @return {*}
     */
    static get(key) {
        return this.storage[key];
    }
}