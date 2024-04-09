/**
 * Main storage for the messages.
 * Singleton
 */
class Messages
{
    /**
     * Represents a variable storage.
     * @typedef {Array} Storage
     */
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
     * Retrieves the value associated with the given key from the storage.
     *
     * @param {string} key - The key to retrieve the value for.
     * @return {object|undefined} - The value associated with the key, or undefined if the key does not exist.
     */
    static get(key) {
        const storedValue = this.storage[key];
        if (storedValue) {
            return Object.assign({}, storedValue);
        } else {
            return undefined;
        }
    }

    /**
     * Retrieves all items from the storage.
     *
     * @returns {Array} - An array containing all items in the storage.
     */
    static getAll() {
        return this.storage;
    }
}