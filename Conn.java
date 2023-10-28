package io.appium.java_client.android.connection;

public class ConnectionState {
    public static final long AIRPLANE_MODE_MASK = 0b001;
    public static final long WIFI_MASK = 0b010;
    public static final long DATA_MASK = 0b100;

    private final long bitMask;

    public long getBitMask() {
        return bitMask;
    }

    public ConnectionState(long bitMask) {
        this.bitMask = bitMask;
    }

    /**
     * Is airplane mode enabled or not.
     *
     * @return true if airplane mode is enabled.
     */
    public boolean isAirplaneModeEnabled() {
        return (bitMask & AIRPLANE_MODE_MASK) != 0;
    }

    /**
     * Is Wi-Fi connection enabled or not.
     *
     * @return true if Wi-Fi connection is enabled.
     */
    public boolean isWiFiEnabled() {
        return (bitMask & WIFI_MASK) != 0;
    }

    /**
     * Is data connection enabled or not.
     *
     * @return true if data connection is enabled.
     */
    public boolean isDataEnabled() {
        return (bitMask & DATA_MASK) != 0;
    }
}