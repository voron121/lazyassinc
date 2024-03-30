/**
 * Main storage for the messages.
 * Singleton
 */
class Messages
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
     * Will append data into object.
     * Will not erase old data with the same key
     * @param key
     * @param value
     */
    static append(key, value) {
        if ('undefined' !== typeof this.storage[key]) {
            this.storage[key] = Object.assign(this.storage[key], value);
        } else {
            this.storage[key] = value;
        }
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